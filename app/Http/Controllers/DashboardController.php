<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Project;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $q = staff::join('users','users.id','=','staff.user_id')
        //     ->orderBy('users.lname','ASC')
        //     ->where('users.role','=','2');

        $clientsCount = User::where('users.role','!=','1')->where('users.role','3')->count();
        $staffsCount = User::where('users.role','!=','1')->where('users.role','2')->count();
        $projectsCount = Project::where('status','1')->count();
        $monthProjects = Project::whereMonth('start_date',Carbon::now()->month)->take(5)->get();
        $latestProjects = Project::selectRaw('
            projects.id,
            projects.name,
            count(tasks.id) as total_tasks
        ')
        ->join('tasks','tasks.project_id','=','projects.id')
        ->groupBy([
            'projects.id',
            'projects.name',
        ])
        ->orderBy('tasks.updated_at')
        ->take(5)
        ->get();

        return view('dashboard',compact(['staffsCount','clientsCount','projectsCount','monthProjects','latestProjects']));
    }
}
