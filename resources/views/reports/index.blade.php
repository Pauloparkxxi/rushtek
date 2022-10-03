<x-app-layout>
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <div>
    <div class="flex justify-center h-screen font-sans">
        <form method="GET" action={{ route('reports') }} class="w-1/5 flex flex-col h-full">
            <div class="w-full justify-center shadow bg-white h-1/4">
                <h3 class="text-1xl p-2 text-green-100 bg-green-700">Date Range</h3>
                <div class="m-2 text-green-900 h-fit align-middle items-center justify-center">
                    <input name="projectDate" datepicker type="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded w-full" placeholder="Select date" value="{{date('Y-m',strtotime($date))}}" onchange='changeDate(this.value)'>

                </div>
                <h3 class="text-1xl p-2 text-green-100 bg-green-700">Project Status</h3>
                <div>
                    <select name="projectStatus" id="idProjectStatus" class="rushtek-multiple w-full h-full pl-3 pr-6 text-sm placeholder-gray-600 border apperance-none focus:shadow-outline">
                        <option value="3" @if (array_key_exists("projectStatus", $query) && $query['projectStatus'] == 3) selected @endif>All</option>
                        <option value="1" @if (array_key_exists("projectStatus", $query) && $query['projectStatus'] == 1) selected @endif>Active</option>
                        <option value="0" @if (array_key_exists("projectStatus", $query) && $query['projectStatus'] == 0) selected @endif>Inactive</option>
                    </select>
                </div>
                <h3 class="text-1xl p-2 text-green-100 bg-green-700">Task Status</h3>
                <div class="w-full">
                    <select name="taskStatus[]" id="idTaskStatus" class="rushtek-multiple w-full h-full placeholder-gray-600 apperance-none focus:shadow-outline text-sm" multiple="multiple">
                        <option value="1" @if (array_key_exists("taskStatus", $query) && in_array(1,$query['taskStatus'])) selected  @endif>Todo</option>
                        <option value="2" @if (array_key_exists("taskStatus", $query) && in_array(2,$query['taskStatus'])) selected  @endif>WIP</option>
                        <option value="3" @if (array_key_exists("taskStatus", $query) && in_array(3,$query['taskStatus'])) selected  @endif>Finished</option>
                    </select>
                </div>
                <h2 class="text-1xl p-2 text-green-100 bg-green-700 h-fit">
                    Projects <br>
                </h2>
                <div class="bg-white text-green-900 w-full overflow-y-scroll" id="idProjectsCheck">
                    @foreach ($projects as $project)
                        <span>
                            <input name="projectFilter[]" type="checkbox" class="text-sm classProject" value="{{$project->id}}" @if (array_key_exists("projectFilter", $query) && in_array($project->id, $query['projectFilter'])) checked @endif> {{$project->name}}
                        </span> <br>
                    @endforeach
                </div>
                <h2 class="text-1xl p-2 text-green-100 bg-green-700 h-fit">
                    <input type="submit" class="button border border-white rounded py-0 px-2 hover:bg-blue-500 hover:text-white" value="Filter">
                    <a class="button border border-white rounded py-0 px-2 hover:bg-red-500 hover:text-white">Clear</a>
                </h2>
            </div>
        </form>
        <div class="w-4/5 h-full">
            <div id="tasks" style="height:100vh; width:100%"></div>
        </div>
    </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    gantt.config.time_picker = "%H:%s";
    gantt.config.date_format = "%Y-%m-%d %H:%i:%s";
    gantt.config.readonly = true;
    gantt.config.min_column_width = 1;
    gantt.config.columns = [
		{name: "text", label: "Task name", tree: true, width: "225", resize:true},
	];
    gantt.config.min_task_grid_row_height = 45;
    
    gantt.config.scales = [
        {unit: "month", step: 1, format: "%F, %Y"},
        {unit: "day", step: 1, format: "%d"}
    ];
    
    gantt.plugins({ 
        tooltip: true 
    }); 

    // Tooltip
    gantt.templates.tooltip_text = function(start,end,task){
        start_date = formatDate(start);
        end_date = formatDate(end);
        if (task.parent.charAt(0) === 'p') {
            task_status = ["","Todo","Work In Progress","Finished"]
            status = task_status[task.status] ? task_status[task.status] : "None";
            return "<b>Task:</b> "+ task.text + "<br/><b>Status:</b>" + status + "<br/><b>Cost:</b>" + parseFloat(task.cost).toLocaleString('en-US', { style: 'currency', currency: 'PHP' }) + "<br/><b>Progress:</b> " + Math.round(task.progress * 100)+"%" + "<br/><b>Start Date:</b> " + start_date + "<br/><b>End Date:</b> " + end_date;
        }else {
            task_status = ["Inactive","Active"]
            status = task_status[task.status] ? task_status[task.status] : "None";
            return "<b>Project:</b> "+ task.text + "<br/><b>Status:</b>" + status + "<br/><b>Budget:</b>" + parseFloat(task.budget).toLocaleString('en-US', { style: 'currency', currency: 'PHP' }) + "<br/><b>Cost:</b>" + parseFloat(task.cost).toLocaleString('en-US', { style: 'currency', currency: 'PHP' }) +  "<br/><b>Progress:</b> " + Math.round(task.progress * 100)+"%" + "<br/><b>Start Date:</b> " + start_date + "<br/><b>End Date:</b> " + end_date;
        }
    }

    // Task or Project Class assign
    gantt.templates.task_class=function(start, end, task){ 
        var assignClass = "";
        if(task.parent.charAt(0) === 'p') {
            assignClass = "task";
        } else {
            assignClass = "project";
        }

        if (task.status == 1) {
            assignClass += " todo"
        } else if (task.status == 2) {
            assignClass += " wip"
        } else {
            assignClass += " finished"
        }

        return assignClass
    };

    // Progress
    gantt.templates.progress_text = function (start, end, task) {
        return "";
	};

    // Task
    gantt.templates.task_text=function(start,end,task){
        return "<span style='text-align:left'>" + Math.round(task.progress * 100) + "% </span>";
    };

    gantt.init("tasks",new Date("{{date('Y-m-1',strtotime($date))}}"),new Date("{{date('Y-m-t',strtotime($date))}}"));
    gantt.parse({
        data:[
        @foreach ($data as $data)
        { 
            "id": "{{$data['id']}}", 
            "text": "{{$data['text']}}", 
            "start_date": "{{$data['start_date']}}", 
            "end_date": "{{$data['end_date']}}",
            "parent":"{{$data['parent']}}", 
            "budget":"{{$data['budget']}}",
            "cost":"{{$data['cost']}}",
            "progress":"{{$data['progress']}}",
            "open": true, 
            "readonly": true,
            "status": "{{$data['status']}}"
        },
        @endforeach
    ],
    })
</script>

<script>
    function changeDate(date) {
        var url = "{{route('reports','projectDate=:id')}}".replace(':id',date+'-01');
        window.location.href = url;
    }
</script>

<style>
    .taskStatus{
        font-size:13px;
    }
</style>