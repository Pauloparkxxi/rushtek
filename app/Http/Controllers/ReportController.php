<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Dhtmlx\Connector\GanttConnector;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $month_start = date('Y-m-01');
        $month_end = date('Y-m-t');
        $date = ($request->query('projectDate')) ? $request->query('projectDate').'-01' : $month_start;
        $date_end = ($request->query('projectDate')) ? date('Y-m-t',strtotime($date)) : $month_end;

        # Projects
        $sqlProjects = Project::selectRaw('projects.id, projects.name')
            ->orderBy('name','asc');

        # Project Assign
        if (Auth::user()->role == 2) {
            $sqlProjects->join('project_members','project_members.project_id','=','projects.id')
                ->where('project_members.user_id','=',Auth::user()->id);
        } else if (Auth::user()->role == 3){
            $sqlProjects->where('projects.client_id',Auth::user()->id);
        }
        
        # Project Date
        $sqlProjects->Where('projects.end_date','>=',date('Y-m-d',strtotime($date)));
        $sqlProjects->Where('projects.start_date','<=',date('Y-m-d',strtotime($date_end)));
        
        # Project Status
        if ($request->query('projectStatus')) {
            // FILTER ONLY IF ACTIVE (1) OR INACTIVE (0)
            if ($request->query('projectStatus') === '0' || $request->query('projectStatus') == 1) {
                $sqlProjects->where('projects.status','=',$request->query('projectStatus') + 0);
            }
        } else {
            // SELECT ALL ACTIVE IF NO PROJECT STATUS FILTER
            $sqlProjects->where('projects.status','=',1);
        }


        // dd($sqlProjects);
        $projects = $sqlProjects->get();

        # Task Projects
        $tasks;
        if ($request->query('taskStatus')) {
            $tasks = Task::whereIn('tasks.status',$request->query('taskStatus'))
            ->orderBy('tasks.id','ASC')
            ->get();
        } else {
            $tasks = Task::orderBy('tasks.id','ASC')->get();
        }

        $sqlProjectTasks = Project::selectRaw('
            projects.id as project_id,
            projects.name,
            projects.start_date,
            projects.end_date,
            projects.status,
            projects.budget,
            count(tasks.id) as total_tasks,
            sum(
                case
                    when tasks.status = 3 then 1
                    else 0
                end
            ) as finished_tasks,
            sum(tasks.cost) as tasks_costs,
            clients.company
        ')
        ->leftJoin('clients','clients.user_id','=','projects.client_id')
        ->leftJoin('tasks','tasks.project_id','=','projects.id')
        ->groupBy([
            'projects.id',
            'projects.name',
            'projects.start_date',
            'projects.end_date',
            'projects.status',
            'projects.budget',
            'clients.company'
        ])
        ->orderBy('projects.name','ASC');

        # Project Assign
        if (Auth::user()->role == 2) {
            $sqlProjectTasks->join('project_members','project_members.project_id','=','projects.id')
                ->where('project_members.user_id','=',Auth::user()->id);
        } else if (Auth::user()->role == 3){
            $sqlProjectTasks->where('projects.client_id',Auth::user()->id);
        }

        // Project Status Filter
        if ($request->query('projectStatus')) {
            // FILTER ONLY IF ACTIVE (1) OR INACTIVE (0)
            if ($request->query('projectStatus') === '0' || $request->query('projectStatus') == 1) {
                $sqlProjectTasks->where('projects.status','=',$request->query('projectStatus'));
            }
        } else {
            // SELECT ALL ACTIVE IF NO PROJECT STATUS FILTER
            $sqlProjectTasks->where('projects.status','=',1);
        }

        // Date Filter
        if ($request->query('projectDate')) {
            $sqlProjectTasks->where('projects.end_date','>=',date('Y-m-d',strtotime($request->query('projectDate'))));
        }

        // Project Filter
        if ($request->query('projectFilter')) {
            $sqlProjectTasks->whereIn('projects.id',$request->query('projectFilter'));
        }
        $projectTasks = $sqlProjectTasks->get();

        $data = [];
        $links = [];

        foreach ($projectTasks as $projectTask) {
            $record = [
                'id' => "p".$projectTask->project_id,
                // 'text' => $str = substr($projectTask->name, 0, 45) . '...',
                'text' => $projectTask->name,
                // 'start_date' => strtotime($projectTask->start_date) < strtotime($month_start) ? $month_start : $projectTask->start_date,
                'end_date' => $projectTask->end_date,
                'open'  => true,
                'readonly' => true,
                'progress' => $projectTask->total_tasks ?($projectTask->finished_tasks / $projectTask->total_tasks) : 0,
                'budget' => $projectTask->budget ? $projectTask->budget : 0,
                'cost'   => $projectTask->tasks_costs ? $projectTask->tasks_costs : 0, 
                'parent' => 0,
                'status' => $projectTask->status
            ];

            if (strtotime($projectTask->start_date) < strtotime($month_start)) {
                $record['start_date'] = $projectTask->start_date;
            } else {
                $record['start_date'] = strtotime($projectTask->start_date) < strtotime($month_start) ? $month_start : $projectTask->start_date;
            }

            array_push($data,$record);
        }

        foreach ($tasks as $task) {
            $record = [
                'id' => "t".$task->id,
                'text' => $task->name,
                'start_date' => $task->start_date,
                'end_date' => $task->end_date,
                'progress' => $task->progress/100,
                'readonly' => true,
                'progress' => $task->progress ? $task->progress / 100 : 0,
                'budget' => 0,
                'cost' => $task->cost ? $task->cost : 0,
                'parent' => "p".$task->project_id,
                'status' => $task->status
            ];

            array_push($data,$record);
        }

        // dd($projects,$projectTasks,$tasks,$data, $links);

        $query = $request->query ? array_merge(array(), $request->query->all()) : [];
        return view('reports.index',compact('projects','data','links','query','date'));
    }

}
