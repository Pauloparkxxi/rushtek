<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskMember;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($project_id) {
        $project = Project::find($project_id);
        $tasks = Task::where('project_id',$project_id)
            ->orderBy('id','ASC')
            ->get();

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
        $request->validate([
            'name'      => 'required|max:255',
            'start_date'=> 'required|date',
            'end_date'  => 'required|date|after_or_equal:start_date',
            'progress'  => 'required',
            'cost'      => 'required',
            'status'    => 'required',
        ]);

        $task = Task::create([
            'project_id'    => $project_id,
            'name'          => $request->name,
            'text'          => $request->text,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'progress'      => $request->progress,
            'cost'          => $request->cost,
            'status'        => $request->status
        ]);

        if ($request->projectMembers) {
            foreach ($request->projectMembers as $member) {
                $task_member = TaskMember::create([
                    'task_id'   => $task->id,
                    'user_id'   => $member
                ]);
            }
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

        // dd($members);

        return view('tasks.detail',compact(['task','project_members','project','members']));
    }

    public function update(Request $request, $id) {
        $task = Task::find($id);

        if (Auth::user()->role == 1) {
            $request->validate([
                'name'      => 'required|max:255',
                'start_date'=> 'required|date',
                'end_date'  => 'required|date|after_or_equal:start_date',
                'progress'  => 'required',
                'cost'      => 'required',
                'status'    => 'required',
            ]);
            $task->update([
                'name'          => $request->name,
                'text'   => $request->text,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'progress'      => $request->progress,
                'cost'          => $request->cost,
                'status'        => $request->status
            ]);
    
            if ($request->taskMembers) {
                //Recreate Task Members
                TaskMember::where('task_id',$id)->delete();
                foreach ($request->taskMembers as $member) {
                    $task_member = TaskMember::create([
                        'task_id'   => $task->id,
                        'user_id'   => $member
                    ]);
                }
            }
        } else if (Auth::user()->role == 2) {
            $request->validate([
                'progress'  => 'required',
                'cost'      => 'required',
                'status'    => 'required',
            ]);
            $task->update([
                'text'          => $request->text,
                'progress'      => $request->progress,
                'status'        => $request->status,
                'cost'          => $request->cost
            ]);

        }

        return redirect(route('tasks.detail',$id))->with('alert', 'Task Updated!');
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $project_id = $task->project_id;
        $task->delete();
        TaskMember::where('task_id','=',$id)->delete();
        return redirect(route('tasks',$project_id))->with('alert', 'Task Deleted!');
    }
}
