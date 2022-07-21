<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Client;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = Project::select(['projects.*', 'clients.company'])
            ->leftJoin('clients','clients.user_id','=','projects.client_id')
            ->orderBy('name','ASC');

        $status = 1;
        $search = '';
        if ($request->has('search') && Str::length($request->search) > 0) {
            $search = $request->search;
            $q->where('name','Like','%'.$search.'%');
        }
        if ($request->has('status')){
            switch($request->status) {
                case 'active':
                    $status = 1;
                    break;
                case 'inactive':
                    $status = 0;
                    break;
                case 'all':
                    $status = 3;
                default:
            }
        }

        if ($status != 3) {
            $q->where('status','=',$status);
        }

        $projects = $q->paginate(10);
        // dd($projects);

        return view('projects.index',compact(['projects','search','status']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = staff::where('users.role',2)
            ->where('users.status',1)
            ->join('users','users.id','=','staff.user_id')
            ->orderBy('users.lname','ASC')
            ->get();

        $clients = client::where('users.role',3)
            ->where('users.status',1)
            ->join('users','users.id','=','clients.user_id')
            ->orderBy('users.lname','ASC')
            ->get();

        return view('projects.create',compact(['staffs','clients']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'budget'          => $request->budget,
            'client_id'     => $request->client,
            'status'        => 1
        ]);

        foreach ($request->projectMembers as $member) {
            ProjectMember::create([
                'project_id'    => $project->id,
                'user_id'       => $member
            ]);
        }

        return redirect(route('projects'))->with('alert', 'Project Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $project = project::select(['projects.*','clients.company'])
            ->leftJoin('clients','clients.user_id','=','projects.client_id')
            ->find($id);

        $project_members = ProjectMember::where('project_id',$id)->get();

        $staffs = staff::where('users.role',2)
            ->where('users.status',1)
            ->join('users','users.id','=','staff.user_id')
            ->orderBy('users.lname','ASC')
            ->get();

        $clients = client::where('users.role',3)
            ->where('users.status',1)
            ->join('users','users.id','=','clients.user_id')
            ->orderBy('users.lname','ASC')
            ->get();

        $members = array();
        foreach($project_members as $project_member) {
            array_push($members,$project_member->user_id);
        }
        return view('projects.detail',compact(['project','staffs','clients','members']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'budget'        => $request->budget,
            'client_id'     => $request->client,
            'status'        => $request->status,
        ]);

        $project_members = ProjectMember::where('project_id',$id)->delete();

        if($request->projectMembers) {
            foreach ($request->projectMembers as $member) {
                ProjectMember::create([
                    'project_id'    => $project->id,
                    'user_id'       => $member
                ]);
            }
        }

        // dd($project);

        return redirect(route('projects.detail',$id))->with('alert', 'Project Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Project::find($id)->delete();
        //TODO Delete Project Members
        //TODO Delete Project Tasks
        return redirect(route('projects'))->with('alert', 'Project Deleted!');
    }
}
