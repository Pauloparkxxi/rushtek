<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto py-0 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="items-center hidden lg:block md:hidden">
                    <a href="{{ route('dashboard') }}">
                        <img class="py-2" width="250px" src="{{ asset('asset/img/logo.png') }}" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-5 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16"> <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" fill="#188f00"></path> </svg>
                        <span class="pl-1">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('projects')">
                        <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16"> <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z" fill="#188f00"></path> </svg>
                        <span class="pl-1">{{ __('Projects') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('reports')">
                        <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M464 64C490.5 64 512 85.49 512 112V176C512 202.5 490.5 224 464 224H48C21.49 224 0 202.5 0 176V112C0 85.49 21.49 64 48 64H464zM448 128H320V160H448V128zM464 288C490.5 288 512 309.5 512 336V400C512 426.5 490.5 448 464 448H48C21.49 448 0 426.5 0 400V336C0 309.5 21.49 288 48 288H464zM192 352V384H448V352H192z" fill="#188f00"></path></svg>
                        <span class="pl-1">{{ __('Reports') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('admins')" :active="request()->routeIs('admins.*') || request()->routeIs('admins')">
                        <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"> <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill="#188f00"></path> </svg>
                        <span class="pl-1">{{ __('Admin') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('staffs')" :active="request()->routeIs('staffs.*') || request()->routeIs('staffs') || request()->routeIs('departments') || request()->routeIs('departments.*')">
                        <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16"> <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill="#188f00"></path> <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" fill="#188f00"></path> <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" fill="#188f00"></path> </svg>
                        <span class="pl-1">{{ __('Staff') }}</span>
                    </x-nav-link>
                    <x-nav-link :href="route('clients')" :active="request()->routeIs('clients.*') || request()->routeIs('clients')">
                        <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M384 0H96C60.65 0 32 28.65 32 64v384c0 35.35 28.65 64 64 64h288c35.35 0 64-28.65 64-64V64C448 28.65 419.3 0 384 0zM240 128c35.35 0 64 28.65 64 64s-28.65 64-64 64c-35.34 0-64-28.65-64-64S204.7 128 240 128zM336 384h-192C135.2 384 128 376.8 128 368C128 323.8 163.8 288 208 288h64c44.18 0 80 35.82 80 80C352 376.8 344.8 384 336 384zM496 64H480v96h16C504.8 160 512 152.8 512 144v-64C512 71.16 504.8 64 496 64zM496 192H480v96h16C504.8 288 512 280.8 512 272v-64C512 199.2 504.8 192 496 192zM496 320H480v96h16c8.836 0 16-7.164 16-16v-64C512 327.2 504.8 320 496 320z" fill="#188f00"></path></svg>
                        <span class="pl-1">{{ __('Client') }}</span>
                    </x-nav-link>
                </div>
            </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="items-center float-right hidden lg:flex md:flex hover:underline">
                    <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->avatar ? asset('asset/img/profile/'.Auth::user()->avatar) : asset('asset/img/profile/default_profile.png') }}" alt="">
                    <div class="px-1 font-medium dark:text-white">
                        <a href={{ route('profile') }} class="text-sm text-black">{{Auth::user()->lname}}, {{Auth::user()->fname}}</a>
                        <div class="text-xs text-gray-500 dark:text-gray-400">IT - Programmer</div>
                    </div>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <span class="flex items-center">
                                    <svg style="height: 14; width: 14; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" fill="#188f00"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    <span class="px-1 py-1">{{ __('Log Out') }}</span>
                                </span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex-shrink-0 float-left absolute sm:hidden">
                <a href="{{ route('dashboard') }}">
                    <img class="py-2" width="250px" src="{{ asset('asset/img/logo.png') }}" />
                </a>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex justify-start items-center">
                <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16"> <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" fill="#188f00"></path> </svg>
                <span class="pl-1">{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('projects')" class="flex justify-start items-center">
                <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16"> <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z" fill="#188f00"></path> </svg>
                <span class="pl-1">{{ __('Projects') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('reports')" class="flex justify-start items-center">
                <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M464 64C490.5 64 512 85.49 512 112V176C512 202.5 490.5 224 464 224H48C21.49 224 0 202.5 0 176V112C0 85.49 21.49 64 48 64H464zM448 128H320V160H448V128zM464 288C490.5 288 512 309.5 512 336V400C512 426.5 490.5 448 464 448H48C21.49 448 0 426.5 0 400V336C0 309.5 21.49 288 48 288H464zM192 352V384H448V352H192z" fill="#188f00"></path></svg>
                <span class="pl-1">{{ __('Reports') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admins')" :active="request()->routeIs('admins.*') || request()->routeIs('admins')" class="flex justify-start items-center">
                <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"> <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill="#188f00"></path> </svg>
                <span class="pl-1">{{ __('Admin') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('staffs')" :active="request()->routeIs('staffs.*') || request()->routeIs('staffs') || request()->routeIs('departments') || request()->routeIs('departments.*')" class="flex justify-start items-center">
                <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16"> <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" fill="#188f00"></path> <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" fill="#188f00"></path> <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" fill="#188f00"></path> </svg>
                <span class="pl-1">{{ __('Staff') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clients')" :active="request()->routeIs('clients.*') || request()->routeIs('clients')" class="flex justify-start items-center">
                <svg style="height: 14px; width: 14px; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M384 0H96C60.65 0 32 28.65 32 64v384c0 35.35 28.65 64 64 64h288c35.35 0 64-28.65 64-64V64C448 28.65 419.3 0 384 0zM240 128c35.35 0 64 28.65 64 64s-28.65 64-64 64c-35.34 0-64-28.65-64-64S204.7 128 240 128zM336 384h-192C135.2 384 128 376.8 128 368C128 323.8 163.8 288 208 288h64c44.18 0 80 35.82 80 80C352 376.8 344.8 384 336 384zM496 64H480v96h16C504.8 160 512 152.8 512 144v-64C512 71.16 504.8 64 496 64zM496 192H480v96h16C504.8 288 512 280.8 512 272v-64C512 199.2 504.8 192 496 192zM496 320H480v96h16c8.836 0 16-7.164 16-16v-64C512 327.2 504.8 320 496 320z" fill="#188f00"></path></svg>
                <span class="pl-1">{{ __('Client') }}</span>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 flex justify-start items-center hover:underline">
                <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->avatar ? asset('asset/img/profile/'.Auth::user()->avatar) : asset('asset/img/profile/default_profile.png') }}" alt="">
                <span class="px-2">
                    <a href="{{ route('profile') }}" class="font-medium text-base text-gray-800">{{ Auth::user()->lname }}, {{ Auth::user()->fname }}</a>
                    <div class="font-medium text-sm text-gray-500">IT - Programmer</div>
                </span>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <span class="flex items-center">
                            <svg style="height: 14; width: 14; color: rgb(24, 143, 0);" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" fill="#188f00"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            <span class="px-1 py-1">{{ __('Log Out') }}</span>
                        </span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
