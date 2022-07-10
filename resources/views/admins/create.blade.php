<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Add Admin</h1>
            <a href="{{ route('admins') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 flex align-middle items-center justify-center space-x-3">
                    <img id="idAvatarPreview" class="border border-green-900 w-48 h-48 object-cover rounded-full" 
                    src="{{ asset('asset/img/default_profile.png') }}" width="200" height="150" />
                
                    <span class="flex-wrap">
                        <x-label for="product_photo" :value="__('Photo (Photo will not be changed if empty)')" />
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
                    <x-label :value="__('Email')" />
    
                    <input value="" type="email" name="email" id="idEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Password')" />
    
                    <input value="" type="password" name="password" id="idPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" onclick="return confirm('Are you sure to add?')">
                        {{ __('Add Admin') }}
                    </x-button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>