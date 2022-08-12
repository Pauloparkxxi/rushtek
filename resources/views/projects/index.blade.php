<x-app-layout>
    @if ($message = Session::get('alert'))
          <x-alert  />
    @endif
    
    <div class="py-3">
        <div class="max-w-6xl mx-auto">
            <div class="m-2 flex flex-wrap justify-between items-center">
                <span class="flex flex-wrap items-center">
                    <h1 class="text-5xl mx-2 font-bold leading-tight">Projects</h1>
                    @if (Auth::user()->role == 1)
                    <span class="flex-none justify-between space-x-2">
                        <a href="{{ route('projects.create') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
                        focus:outline-none hover:bg-green-800">
                            Add Project
                        </a>
                    </span>
                    @endif
                </span>
                <form method="GET" autocomplete="off" action={{ route('projects') }} class="flex flex-wrap justify-end items-center">
                    <div class="flex flex-wrap justify-between items-center lg:space-x-5 mx-4">
                        <div class="form-check">
                                <input class="form-check-input appearance-none rounded-full h-4 w-4 checked:bg-green-600 text-green-600 mt-1 align-top float-left cursor-pointer" value="active" type="radio" name="status" id="idStatus" @if($status == 1) checked @endif>
                            <label class="form-check-label inline-block text-gray-800" for="statusRadio1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input appearance-none rounded-full h-4 w-4 checked:bg-green-600 text-green-600 mt-1 align-top float-left cursor-pointer" value="inactive" type="radio" name="status" id="idStatus" @if($status == 0) checked @endif>
                            <label class="form-check-label inline-block text-gray-800" for="statusRadio2">
                                Inactive
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input appearance-none rounded-full h-4 w-4 checked:bg-green-600 text-green-600 mt-1 align-top float-left cursor-pointer" value="all" type="radio" name="status" id="idStatus" @if($status == 3) checked @endif>
                            <label class="form-check-label inline-block text-gray-800" for="statusRadio3">
                                All
                            </label>
                        </div>
                    </div>
                    <span class="flex-none items-center">
                        <input type="search" value="{{ $search }}" name="search" id="idSearch" class="text-sm text-green-900 bg-gray-50 rounded-lg border border-green-400 focus:ring-green-500" placeholder="Search Projects">
                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 text-sm rounded-lg px-4 py-2 align-middle">
                            <svg style="height: 18px; width: 18px; color: rgb(255, 255, 255);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" fill="#ffffff"></path> </svg>
                        </button>
                    </span>
                </form>
            </div>
            <div class="justify-evenly px-2">
                <div class="w-full shadow bg-white">
                    <div class="p-2">
                        <table class="table-fixed overflow-scroll w-full">
                            <thead class="text-left text-white bg-green-700">
                                <tr>
                                    <th class="p-2">Project Name</th>
                                    <th class="p-2 hidden md:table-cell">Company</th>
                                    <th class="p-2 hidden md:table-cell">Start Date</th>
                                    <th class="p-2 hidden md:table-cell">End Date</th>
                                    <th class="p-2 hidden sm:table-cell">Progress</th>
                                    <th class="p-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($projects as $project)
                            <a href="">
                                <tr class="border-b border-gray-200 hover:bg-green-100">
                                    <td class="p-2 items-center flex">
                                        <span class="font-medium mx-3">{{$project->name}}</span>
                                    </td>
                                    <td class="p-2 hidden md:table-cell">
                                        <span class="font-medium">{{$project->company ? $project->company : 'None'}}</span>
                                    </td>
                                    <td class="p-2 hidden md:table-cell">
                                        <span class="font-medium">{{$project->start_date}}</span>
                                    </td>
                                    <td class="p-2 hidden md:table-cell">
                                        <span class="font-medium">{{$project->end_date}}</span>
                                    </td>
                                    <td class="p-2 hidden sm:table-cell">
                                        <span class="font-medium">
                                            @if ($project->total_tasks)
                                                {{ round(($project->finished_tasks / $project->total_tasks) * 100) }}%
                                            @else
                                                No Tasks
                                            @endif
                                        </span>
                                    </td>
                                    <td class="p-2">
                                        <span class="flex flex-wrap items-center justify-center space-x-2">
                                            <a href="{{ route('projects.detail', $project->id + 0) }}" class="btn bg-white my-1 hover:bg-green-700 hover:text-white rounded-lg px-3 border border-green-600">
                                                View
                                            </a>
                                            @if (Auth::user()->role == 1)
                                            <a href="{{ route('projects.delete', $project->id + 0) }}" class="btn bg-white my-1 hover:bg-red-700 hover:text-white hover:border-red-700 rounded-lg px-3 border border-green-600" onclick="return confirm('Are you sure to delete?')">
                                                Delete
                                            </a>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            </a>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $projects->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>