<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <div class="py-3">
        <div class="max-w-6xl mx-auto">
            <div class="m-2 flex flex-wrap justify-between items-center">
                <span class="flex flex-wrap items-center">
                    <h1 class="text-5xl mx-2 font-bold leading-tight">Staffs</h1>
                    <span class="flex-none justify-between space-x-2">
                        <a href="{{ route('dashboard') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
                        focus:outline-none hover:bg-green-800">
                            Add Staff
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 focus:outline-none hover:bg-green-800">
                            View Departments
                        </a>
                    </span>
                </span>
                <form class="flex flex-wrap justify-end items-center">
                    <div class="flex flex-wrap justify-between items-center lg:space-x-5 mx-4">
                        <div class="form-check">
                            <input class="form-check-input appearance-none rounded-full h-4 w-4 checked:bg-green-600 text-green-600 mt-1 align-top float-left cursor-pointer" type="radio" name="statusRadio" id="statusRadio1" checked>
                            <label class="form-check-label inline-block text-gray-800" for="statusRadio1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input appearance-none rounded-full h-4 w-4 checked:bg-green-600 text-green-600 mt-1 align-top float-left cursor-pointer" type="radio" name="statusRadio" id="statusRadio2">
                            <label class="form-check-label inline-block text-gray-800" for="statusRadio2">
                                Inactive
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input appearance-none rounded-full h-4 w-4 checked:bg-green-600 text-green-600 mt-1 align-top float-left cursor-pointer" type="radio" name="statusRadio" id="statusRadio3">
                        <label class="form-check-label inline-block text-gray-800" for="statusRadio3">
                            All
                        </label>
                        </div>
                    </div>
                    <span class="flex-none items-center">
                        <input type="search" id="default-search" class="text-sm text-green-900 bg-gray-50 rounded-lg border border-green-400 focus:ring-green-500"required>
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
                                    <th class="p-2">Staff Name</th>
                                    <th class="p-2">Department Name</th>
                                    <th class="p-2">Contact #</th>
                                    <th class="p-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($staffs as $staff)
                            <tr class="border-b border-gray-200 hover:bg-green-100">
                                <td class="p-2 items-center flex">
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('asset/img/1.jpg') }}" alt="">
                                    <span class="font-medium mx-3">{{ $staff->lname }}, {{ $staff->fname }}</span>
                                </td>
                                <td class="p-2">
                                    <span class="font-medium">{{ $staff->deparment_id ? $staff->department_id : 'None'}}</span>
                                </td>
                                <td class="p-2">
                                    <span class="font-medium">{{ $staff->contact ? $staff->contact : 'None' }}</span>
                                </td>
                                <td class="p-2">
                                    <span class="flex flex-wrap items-center justify-center space-x-2">
                                        <a href="{{ route('staffs') }}" class="btn bg-white my-1 hover:bg-green-700 hover:text-white rounded-lg px-3 border border-green-600">
                                            View
                                        </a>
                                        <a href="{{ route('staffs') }}" class="btn bg-white my-1 hover:bg-red-700 hover:text-white hover:border-red-700 rounded-lg px-3 border border-green-600">
                                            Delete
                                        </a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $staffs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>