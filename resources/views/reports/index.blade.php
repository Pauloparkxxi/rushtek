<x-app-layout>
    @if ($message = Session::get('alert'))
        <x-alert  />
    @endif
    <div>
    <div class="flex justify-center h-screen font-sans">
        <div class="w-1/5 flex flex-col h-full">
            <div class="w-full justify-center shadow bg-white h-1/4">
                <h3 class="text-1xl p-2 text-green-100 bg-green-700">Date Range</h3>
                <div class="m-2 text-green-900 h-fit align-middle items-center justify-center">
                    <input datepicker type="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded w-full" placeholder="Select date" value="2022-08">

                </div>
                <h3 class="text-1xl p-2 text-green-100 bg-green-700">Project Status</h3>
                <div>
                    <select name="projectMembers" id="idProjectStatus" class="rushtek-multiple w-full h-full pl-3 pr-6 text-sm placeholder-gray-600 border apperance-none focus:shadow-outline" >
                        <option value="3">Active</option>
                        <option value="3">Inactive</option>
                        <option value="3" selected>All</option>
                    </select>
                </div>
                <h3 class="text-1xl p-2 text-green-100 bg-green-700">Task Status</h3>
                <div class="w-full">
                    <select name="projectMembers" id="idTaskStatus" class="rushtek-multiple w-full h-full pl-3 pr-6 placeholder-gray-600 border apperance-none focus:shadow-outline text-sm" multiple="multiple">
                        <option value="3" selected>Todo</option>
                        <option value="3" selected>WIP</option>
                        <option value="3" selected>Finished</option>
                    </select>
                </div>
                <h2 class="text-1xl p-2 text-green-100 bg-green-700 h-fit">
                    Projects <br>
                </h2>
                <div class="bg-white text-green-900 w-full grid grid-cols-1 overflow-y-scroll" id="idProjectsCheck">
                    <!-- @foreach ($projects as $project)
                        <span><input type="checkbox" class="text-sm" value="{{$project->id}}"> {{$project->name}}</span>
                    @endforeach -->
                    <span><input type="checkbox" class="text-sm" value="1" checked> Project 1</span>
                    @for ($x = 2; $x <= 50; $x++)
                        <span><input type="checkbox" class="text-sm" value="{{$x}}"> Project {{$x}}</span>
                    @endfor
                </div>
                <h2 class="text-1xl p-2 text-green-100 bg-green-700 h-fit">
                    <button class="button border border-white rounded py-0 px-2 hover:bg-blue-500 hover:text-white">Filter</button>
                    <button class="button border border-white rounded py-0 px-2 hover:bg-red-500 hover:text-white">Clear</button>
                </h2>
            </div>
        </div>
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
    gantt.config.min_column_width = 50;
    gantt.config.columns = [
		{name: "text", label: "Task name", tree: true, width: "225", resize:true},
	];
    gantt.config.min_task_grid_row_height = 45;
    
    gantt.config.scales = [
        {unit: "month", step: 1, format: "%F, %Y"},
        {unit: "day", step: 1, format: "%d"}
    ];
    
    gantt.init("tasks",new Date("{{date('Y-m-01')}}"),new Date("{{date('Y-m-t')}}"));
    
    
    // gantt.load("{{route('reports.tasks')}}");
    gantt.parse({
        "data": [
        {
        "id": 76,
        "text": "Project 1",
        "start_date": "2022-09-01",
        "end_date": "2022-11-16",
        "open": true,
        "readonly": true
        },
        {
        "id": 76,
        "text": "Project 1",
        "start_date": "2022-08-01",
        "end_date": "2022-08-05",
        "open": true,
        "readonly": true
        },
        {
        "id": 76,
        "text": "Project 1",
        "start_date": "2022-01-01",
        "end_date": "2022-11-16",
        "open": true,
        "readonly": true
        },
        {
        "id": 1,
        "text": "1",
        "start_date": "2022-08-01",
        "end_date": "2022-08-09",
        "progress": 0,
        "readonly": true,
        "parent": 76
        },
        {
        "id": 2,
        "text": "2",
            "start_date": "2022-08-08",
            "end_date": "2022-08-16",
            "progress": 0,
            "readonly": true,
            "parent": 76
        },
        {
        "id": 3,
        "text": "3",
        "start_date": "2022-08-13",
        "end_date": "2022-08-27",
        "progress": 0,
        "readonly": true,
        "parent": 76
        }
        ]
    })


</script>