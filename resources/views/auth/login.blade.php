<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img class="w-full z-50" src="{{ asset('asset/img/logo.png') }}" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" autofocus />
            </div>


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!-- {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <a href="#" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
                focus:outline-none hover:bg-green-800" onclick="admin()">
                    Admin
                </a>

                <a href="#" class="btn bg-yellow-700 text-white font-bold rounded-full px-3 py-1 my-2 
                focus:outline-none hover:bg-yellow-800" onclick="staff()">
                    Staff
                </a>

                <a href="#" class="btn bg-blue-700 text-white font-bold rounded-full px-3 py-1 my-2 
                focus:outline-none hover:bg-blue-800" onclick="client()">
                    Client
                </a> -->

                <x-button class="ml-3" onclick="()=> { alert('hit')  }">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script>
    function admin() {
        $('#username').val('admin123')
        $('#password').val('password')
    }

    function staff() {
        $('#username').val('staff123')
        $('#password').val('password')
    }

    function client() {
        $('#username').val('client123')
        $('#password').val('password')
    }
</script>
