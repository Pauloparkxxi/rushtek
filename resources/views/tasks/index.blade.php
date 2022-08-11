<x-app-layout>
    @if ($message = Session::get('alert'))
          <x-alert  />
    @endif
    
    <div class="py-3">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl mx-2 font-bold leading-tight">Project: {{$project->name}}</h1>
            <div class="m-2 flex flex-wrap justify-between items-center">
                <span class="flex flex-wrap items-center">
                    <h1 class="text-5xl mx-2 font-bold leading-tight">Tasks</h1>
                    <span class="flex-none justify-between space-x-2">
                        @if (Auth::user()->role == 1)
                        <a href="{{ route('tasks.create',$project->id) }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
                            focus:outline-none hover:bg-green-800">
                            Add Task
                        </a>
                        @endif
                        <a href="{{ route('projects.detail',$project->id) }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
                        focus:outline-none hover:bg-green-800">
                            Return
                        </a>
                    </span>
                </span>
            </div>
            <div class="justify-evenly px-2">
                <div class="w-full shadow bg-white">
                    <div class="p-2">
                        <table class="table-fixed overflow-scroll w-full">
                            <thead class="text-left text-white bg-green-700">
                                <tr>
                                    <th class="p-2">Name</th>
                                    <th class="p-2 hidden md:table-cell">Start Date</th>
                                    <th class="p-2 hidden md:table-cell">End Date</th>
                                    <th class="p-2 hidden md:table-cell">Progress</th>
                                    <th class="p-2 hidden md:table-cell">Status</th>
                                    <th class="p-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($tasks) == 0)
                            <tr class="border-b border-gray-200 hover:bg-green-100">
                                <td colspan="6" class="text-center">
                                    <span class="font-medium">No Tasks Yet</span>
                                </td>
                            </tr>
                            @else
                            @foreach ($tasks as $task)
                            <tr class="border-b border-gray-200 hover:bg-green-100">
                                <td class="p-2">
                                    <span class="font-medium mx-3">{{$task->name}}</span>
                                </td>
                                <td class="p-2 hidden md:table-cell">
                                    <span class="font-medium">{{$task->start_date}}</span>
                                </td>
                                <td class="p-2 hidden md:table-cell">
                                    <span class="font-medium">{{$task->end_date}}</span>
                                </td>
                                <td class="p-2 hidden md:table-cell">
                                    <span class="font-medium">{{$task->progress}}%</span>
                                </td>
                                <td class="p-2 hidden md:table-cell">
                                    <span class="font-medium">
                                    @switch($task->status)
                                        @case(1)
                                            Todo
                                            @break
                                        @case(2)
                                            Work In Progress
                                            @break
                                        @case(3)
                                            Finish
                                            @break
                                        @default
                                        @endswitch
                                    </span>
                                </td>
                                <td class="p-2">
                                    <span class="flex flex-wrap items-center justify-center space-x-1">
                                        <a href="{{ route('tasks.detail', $task->id) }}" class="btn bg-white my-1 hover:bg-green-700 hover:text-white rounded-lg px-3 border border-green-600">
                                            View
                                        </a>
                                        @if (Auth::user()->role == 1)
                                        <a href="{{ route('tasks.delete', $task->id) }}" class="btn bg-white my-1 hover:bg-red-700 hover:text-white hover:border-red-700 rounded-lg px-3 border border-green-600" onclick="return confirm('Are you sure to delete?')">
                                            Delete
                                        </a>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>