<x-app-layout>
    @if ($message = Session::get('alert'))
          <x-alert  />
    @endif
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <h1 class="text-5xl font-bold leading-tight">Profile</h1>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                <div class="mt-4 flex align-middle items-center justify-center space-x-3">
                    <img id="idAvatarPreview" class="border border-green-900 w-48 h-48 object-cover rounded-full" 
                    src="{{ $user->avatar ? asset('asset/img/profile/'.$user->avatar) : asset('asset/img/default_profile.png') }}"/>
                
                    <span class="flex-wrap">
                        <x-label for="product_photo" :value="__('Photo (Photo will not be changed if empty)')" />
                        <input type="file" name="avatar" id="idAvatar" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-md items-center">
                    </span>
                </div>
                
                <div class="mt-4">
                    <x-label :value="__('First Name')" />

                    <input value="{{ $user->fname  }}" type="text" name="fname" id="idFname" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Last Name')" />

                    <input value="{{ $user->lname  }}" type="text" name="lname" id="idLname" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                @if($user->role == 2)
                <div class="mt-4">
                    <x-label :value="__('Birthdate')" />
    
                    <input value="2000-01-01" type="date" name="contact" id="idContact" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>
                @endif
    
                <div class="mt-4">
                    <x-label :value="__('Email')" />
    
                    <input value="{{ $user->email }}" type="email" name="email" id="idEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Password')" />
    
                    <input value="" type="password" name="password" id="idPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Password will not be changed if empty">
                </div>
    
                @if($user->role != 1)
                <div class="mt-4">
                    <x-label :value="__('Contact')" />
    
                    <input value="{{ $user->contact }}" type="text" name="user_mobile" id="idUserMobile" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>
                @endif
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3">
                        {{ __('Update Profile') }}
                    </x-button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>