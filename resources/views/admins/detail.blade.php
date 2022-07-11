<x-app-layout>
    @if ($message = Session::get('alert'))
          <x-alert  />
    @endif
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Edit Admin</h1>
            <a href="{{ route('admins') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('admins.update',$user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mt-4 flex align-middle items-center justify-center space-x-3">
                    <img id="idAvatarPreview" class="border border-green-900 w-48 h-48 object-cover rounded-full" 
                    src="{{ $user->avatar ? asset('asset/img/profile/'.$user->avatar) : asset('asset/img/default_profile.png') }}" width="200" height="150" />
                
                    <span class="flex-wrap">
                        <x-label for="" :value="__('Photo (Photo will not be changed if empty)')" />
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

                <div class="mt-4">
                    <x-label :value="__('Email')" />
    
                    <input value="{{ $user->email }}" type="email" name="email" id="idEmail" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"  required>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Password')" />
    
                    <input value="" type="password" name="password" id="idPassword" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" placeholder="Password will not be changed if empty">
                </div>


                <div class="mt-4">
                    <x-label :value="__('Status')" />

                    <select name="status" id="idStatus" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline">
                        <option value="1" @if($user->status == 1) selected @endif>Active</option>
                        <option value="0" @if($user->status == 0) selected @endif>Inactive</option>
                    </select>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" onclick="return confirm('Are you sure to update?')">
                        {{ __('Update Admin') }}
                    </x-button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>