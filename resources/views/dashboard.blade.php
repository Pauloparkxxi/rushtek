<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-5xl font-bold leading-tight sm:mx-4">
                Welcome {{ Auth::user()->fname}}!!
            </h1>
        </div>
        {{-- Projects Count --}}
        <div id="cards" class="grid grid-cols-1 md:grid-cols-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Projects</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">{{ $projectsCount }}</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('projects')}}" class="hover:underline">View Projects</a>
                    </div>
                </div>
            </div>
            {{-- Staffs Count --}}
            @if (Auth::user()->role == 1)
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Staffs</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">{{ $staffsCount }}</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('staffs')}}" class="hover:underline">View Staffs</a>
                    </div>
                </div>
            </div>
            @endif
            {{-- Assigned Staffs Count --}}
            @if (Auth::user()->role == 3)
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Assigned Staffs</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">{{ $staffsCount }}</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-5">
                    </div>
                </div>
            </div>
            @endif
            {{-- Clients Count --}}
            @if (Auth::user()->role == 1 || Auth::user()->role == 2)
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Clients</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">{{ $clientsCount }}</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('clients')}}" class="hover:underline">View Clients</a>
                    </div>
                </div>
            </div>
            @endif
            {{-- My Tasks --}}
            @if (Auth::user()->role == 2)
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">My Tasks</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">{{ $myTasksCount }}</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('reports')}}" class="hover:underline">View Tasks</a>
                    </div>
                </div>
            </div>
            @endif
            @if (Auth::user()->role == 3)
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Project Tasks</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">{{ $myTasksCount }}</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('reports')}}" class="hover:underline">View Tasks</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        {{-- Month Projects --}}
        <div id="summary" class="grid grid-cols-1 md:grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-2xl p-3 text-green-100 bg-green-700">{{date('F')}} Projects</h3>
                    <div class="p-2">
                        <table class="table-auto overflow-scroll w-full">
                            <tbody class="py-2">
                            @if (count($monthProjects) == 0)
                            <tr class="border-b border-gray-200">
                                <td class="p-2 text-center" colspan="3">
                                    No Scheduled Projects For This Month
                                </td>
                            </tr>
                            @else
                            @foreach ($monthProjects as $project)
                            <tr class="border-b border-gray-200 hover:underline ">
                                <td class="p-2 text-left">
                                    <a href="{{ route('dashboard')}}" class="font-medium hover:underline">{{$project->name}}</a>
                                </td>
                                <td class="p-2 text-left hidden md:table-cell">
                                    <span class="font-medium">Start: {{substr($project->start_date, 5, 5)}}</span>
                                </td>
                                <td class="p-2 text-left hidden md:table-cell">
                                    <span class="font-medium">End: {{substr($project->end_date, 5, 5)}}</span>
                                </td>
                                <td class="p-2 text-left lg:hidden md:hidden">
                                    <span class="font-medium">{{substr($project->start_date, 5, 5)}} to {{substr($project->end_date, 5, 5)}}</span>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="p-2 text-right text-green-900" colspan="3">
                                    <a href="{{ route('reports',['date' => date('Y-m-01')])}}" class="hover:underline">View More</a>
                                </td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-2xl p-3 text-green-100 bg-green-700">Latest Project Progress</h3>
                    <div class="p-2">
                        <table class="table-auto overflow-scroll w-full">
                        <tbody class="py-2">
                            @if (count($latestProjects) == 0)
                            <tr class="border-b border-gray-200 hover:underline">
                                <td class="p-2 text-center" colspan="3">
                                    No Project Progress Yet
                                </td>
                            </tr>
                            @else
                            @foreach ($latestProjects as $project)
                            <tr class="border-b border-gray-200 hover:underline">
                                <td class="p-2 text-left">
                                    <a href="{{ route('dashboard')}}" class="font-medium hover:underline">{{$project->name}}</a>
                                </td>
                                <td class="py-2 px-6 text-left hidden lg:block md:block">
                                    <span class="font-medium">
                                        @if ($project->total_tasks > 0)
                                            {{$project->finished_tasks}}/{{$project->total_tasks}}
                                        @else
                                            No Tasks
                                        @endif
                                    </span>
                                </td>
                                <td class="py-2 px-6 text-left">
                                    <span class="font-medium">{{ round(($project->finished_tasks / $project->total_tasks) * 100) }}% Complete</span>
                                </td>
                            </tr>
                            @endforeach
                            @endif 
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="p-2 text-right text-green-900" colspan="3">
                                    <a href="{{ route('projects')}}" class="hover:underline">View More</a>
                                </td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>