<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskMember;
use App\Models\ProjectMember;

class TaskController extends Controller
{
    public function index($project_id) {
        $project = Project::find($project_id);
        $tasks = Task::all();

        return view('tasks.index',compact(['project','tasks']));
    }

    public function create($project_id) {
        $project = Project::find($project_id);
        $project_members = ProjectMember::where('project_id',$project_id)
            ->join('users','users.id','=','project_members.user_id')
            ->get();
        return view('tasks.create',compact(['project','project_members']));
    }

    public function store(Request $request,$project_id) {
        $task = Task::create([
            'project_id'    => $project_id,
            'name'          => $request->name,
            'description'   => $request->description,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'progress'      => $request->progress,
            'cost'          => $request->cost,
            'status'        => $request->status
        ]);

        foreach ($request->projectMembers as $member) {
            $task_member = TaskMember::create([
                'task_id'   => $task->id,
                'user_id'   => $member
            ]);
        }

        return redirect(route('tasks',$project_id))->with('alert', 'Task Added!');
    }

    public function detail($task_id) {
        $task = Task::find($task_id);
        
        $task_members = TaskMember::where('task_id',$task_id)->get();
        
        $project = Project::find($task->project_id);
        
        $project_members = ProjectMember::where('project_id',$task->project_id)
            ->join('users','users.id','=','project_members.user_id')
            ->get();


        $members = array();
        foreach($task_members as $task_member) {
            array_push($members,$task_member->user_id);
        }

        return view('tasks.detail',compact(['task','project_members','project','members']));
    }
}
