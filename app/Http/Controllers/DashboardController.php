<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Project;
use App\Models\TaskMember;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
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
        // Admin Dashboard
        $clientsCount = User::where('users.role','!=','1')->where('users.role','3')->count();
       
       //  Staffs Count
        $staffsCount = User::select('users.id')->where('users.role','!=','1')->where('users.role','2');
        if (Auth::user()->role == 3) {
            $staffsCount->leftJoin('project_members','project_members.user_id','=','users.id')
                ->join('projects','projects.id','=','project_members.project_id')
                ->where('projects.client_id','=',Auth::user()->id)
                ->groupBy([
                    'users.id',
                ]);
        }
        $staffsCount = $staffsCount->get()->count();

        // Projects Count
        $projectsCount = Project::where('status','1');
        if (Auth::user()->role == 2) {
            $projectsCount->where('project_members.user_id','=',Auth::user()->id)
            ->join('project_members','project_members.project_id','=','projects.id');
        }else if (Auth::user()->role == 3) {
            $projectsCount->where('projects.client_id','=',Auth::user()->id);
        }
        $projectsCount = $projectsCount->count();
        
        // Month Projects
        $monthProjects = Project::whereMonth('start_date',Carbon::now()->month);
        if (Auth::user()->role == 2) {
            $monthProjects->where('project_members.user_id','=',Auth::user()->id)
                ->join('project_members','project_members.project_id','=','projects.id');
        } else if (Auth::user()->role == 3) {
            $monthProjects->where('projects.client_id','=',Auth::user()->id);
        }
        $monthProjects = $monthProjects->take(5)->get();
        // dd($monthProjects);

        // Latest Project Tasks Update
        $latestProjects = Project::selectRaw('
                projects.id,
                projects.name,
                count(tasks.id) as total_tasks,
                sum(
                    case
                        when tasks.status = 3 then 1
                        else 0
                    end
                ) as finished_tasks,
                max(tasks.updated_at) as updated
            ')
            ->join('tasks','tasks.project_id','=','projects.id')
            ->groupBy([
                'projects.id',
                'projects.name'
            ]);

        if (Auth::user()->role == 2) {
            $latestProjects->where('project_members.user_id','=',Auth::user()->id)
                ->join('project_members','project_members.project_id','=','projects.id');
        } else if (Auth::user()->role == 3) {
            $latestProjects->where('projects.client_id','=',Auth::user()->id);
        }

        $latestProjects = $latestProjects->orderBy('updated','desc')
            ->take(5)
            ->get();

        // My Tasks
        $myTasksCount = "";
        if (Auth::user()->role == 2) {
            $myTasksCount = TaskMember::where('tasks.status','!=',3)
                ->join('tasks','tasks.id','=','task_members.task_id')
                ->where('task_members.user_id',Auth::user()->id)
                ->count();
        }else if (Auth::user()->role == 3) {
            $myTasksCount = Task::where('tasks.status','!=',3)
                ->leftJoin('projects','projects.id','=','tasks.project_id')
                ->where('projects.client_id','=',Auth::user()->id)
                ->count();
        }

        return view('dashboard',compact(['staffsCount','clientsCount','projectsCount','monthProjects','latestProjects','myTasksCount']));
    }
}
