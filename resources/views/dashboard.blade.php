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
        <div id="cards" class="grid grid-cols-1 md:grid-cols-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Projects</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">53</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('dashboard')}}" class="hover:underline">View Projects</a>
                    </div>
                </div>
            </div>
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Staffs</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">16</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('dashboard')}}" class="hover:underline">View Staffs</a>
                    </div>
                </div>
            </div>
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-3xl p-3 text-green-100 bg-green-700">Clients</h3>
                    <div class="text-right font-bold bg-white max-h-full p-5">
                        <h1 class="text-7xl text-gray-800">30</h1>
                    </div>
                    <div class="bg-white text-right text-green-900 w-full px-4 py-2">
                        <a href="{{ route('dashboard')}}" class="hover:underline">View Clients</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="summary" class="grid grid-cols-1 md:grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-2xl p-3 text-green-100 bg-green-700">July Projects</h3>
                    @for ($i = 1; $i <= 5; $i++)
                    <div class="p-2">
                        <table class="table-auto overflow-scroll w-full">
                        <tbody class="py-2">
                            <tr class="border-b border-gray-200 hover:underline ">
                                <td class="py-3 px-6 text-left">
                                    <a href="{{ route('dashboard')}}" class="font-medium hover:underline">Project 1</a>
                                </td>
                                <td class="py-3 px-6 text-left hidden md:table-cell">
                                    <span class="font-medium">Start: 07-01</span>
                                </td>
                                <td class="py-3 px-6 text-left hidden md:table-cell">
                                    <span class="font-medium">End: 07-05</span>
                                </td>
                                <td class="py-3 px-6 text-left lg:hidden md:hidden">
                                    <span class="font-medium">07/01 - 07/05</span>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    @endfor
                </div>
            </div>
            <div class="justify-evenly p-4">
                <div class="w-full justify-center shadow bg-white">
                    <h3 class="text-2xl p-3 text-green-100 bg-green-700">Projects Progress</h3>
                    <div class="p-2">
                        <table class="table-auto overflow-scroll w-full">
                        <tbody class="py-2">
                            @for ($i = 1; $i <= 5; $i++)
                            <tr class="border-b border-gray-200 hover:underline">
                                <td class="py-3 px-6 text-left">
                                    <a href="{{ route('dashboard')}}" class="font-medium hover:underline">Project 1</a>
                                </td>
                                <td class="py-3 px-6 text-left hidden lg:block md:block">
                                    <span class="font-medium">3/5 Tasks</span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="font-medium">60% Complete</span>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>