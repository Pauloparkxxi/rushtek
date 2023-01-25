<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Add Staff</h1>
            <a href="{{ route('staffs') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('staffs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 flex align-middle items-center justify-center space-x-3">
                    <img class="border border-green-900 w-48 h-48 object-cover rounded-full" 
                    src="{{ asset('asset/img/default_profile.png') }}" width="200" height="150" />

                    <span class="flex-wrap">
                        <input type="file" name="avatar" id="idAvatar" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-md items-center">
                    </span>
                </div>
                
                <div class="mt-4">
                    <x-label :value="__('First Name')" />

                    <input value="" type="text" name="fname" id="idFname" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Last Name')" />

                    <input value="" type="text" name="lname" id="idLname" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Birthdate')" />
                    <input value="" type="date" name="birthdate" id="idBirthdate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Department')" />
    
                    <select name="department" id="idDepartment" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline">
                        @foreach ($departments as $department )
                            <option value="{{ $department->id }}">{{ $department->dep_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Email')" />
    
                    <input value="" type="email" name="email" id="idEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Username')" />
    
                    <input value="" type="text" name="username" id="idUsername" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Password')" />
    
                    <input value="" type="password" name="password" id="idPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"default_profile required>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Contact')" />
    
                    <input value="" type="text" name="contact" id="idContact" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" onclick="return confirm('Are you sure to add?')">
                        {{ __('Add Staff') }}
                    </x-button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>