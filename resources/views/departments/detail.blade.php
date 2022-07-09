<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Edit Department</h1>
            <a href="{{ route('departments') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('dashboard') }}">
                @csrf
                <div class="mt-4">
                    <x-label :value="__('Department Name')" />

                    <input value="{{ $department->dep_name }}" type="text" name="name" id="idDepartment" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Description')" />

                    <textarea id="message" name="description" rows="8" class="block w-full text-gray-900 rounded-lg border border-gray-500" placeholder="Your message...">{{ $department->dep_description }}</textarea>

                </div>

                <div class="mt-4">
                    <x-label :value="__('Status')" />

                    <select name="status" id="idStatus" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline">
                        <option value="1" @if($department->dep_status == 1) selected @endif>Active</option>
                        <option value="0" @if($department->dep_status == 0) selected @endif>Inactive</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" onclick="return confirm('Are you sure to add?')">
                        {{ __('Update Department') }}
                    </x-button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>