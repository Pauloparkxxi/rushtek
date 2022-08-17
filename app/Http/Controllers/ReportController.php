<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Dhtmlx\Connector\GanttConnector;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = Project::select('projects.*')->join('tasks','tasks.project_id','=','projects.id')->get();
        $projects = Project::orderBy('name','asc')->get();
        return view('reports.index',compact('projects'));
    }

    public function tasks() {
        $tasks = Task::all();
        $projects = Project::select('projects.*')->join('tasks','tasks.project_id','=','projects.id')->get();
        $data = [];
        $links = [];

        foreach ($projects as $project) {
            $record = [
                'id' => $project->id,
                'text' => $str = substr($project->name, 0, 45) . '...',
                'start_date' => $project->start_date,
                'end_date' => $project->end_date,
                'open'  => true,
                'readonly' => true
            ];
            array_push($data,$record);
        }

        foreach ($tasks as $task) {
            $record = [
                'id' => $task->id,
                'text' => $task->name,
                'start_date' => $task->start_date,
                'end_date' => $task->end_date,
                'progress' => $task->progress/100,
                'readonly' => true,
                'parent' => $task->project_id

            ];

            array_push($data,$record);
        }

        return response()->json([
            "links" => [],
            "data" => $data
        ]);
    }
}
