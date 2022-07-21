<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Add Project</h1>
            <a href="{{ route('projects') }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('projects.store') }}">
                @csrf

                <div class="mt-4">
                    <x-label :value="__('Project')" />

                    <input value="" type="text" name="name" id="idName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Description')" />

                    <textarea id="message" name="description" rows="8" class="block w-full text-gray-900 rounded-lg border border-gray-500" placeholder="Your message..."></textarea>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Start Date')" />
                    <input value="" type="date" name="start_date" id="idBirthdate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('End Date')" />
                    <input value="" type="date" name="end_date" id="idEndDate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>

                <div class="mt-4">
                    <x-label :value="__('Budget')" />

                    <input value="0" type="number" name="budget" id="idBudget" min="0" class="w-full pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Project Members')" />
    
                    <select name="projectMembers[]" id="idProjectMembers" class="rushtek-multiple w-full h-full pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline" multiple="multiple">
                        @foreach ($staffs as $staff)
                            <option value="{{ $staff->user_id }}">{{ $staff->lname }}, {{ $staff->fname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Project Owner')" />
    
                    <select name="client" id="idClient" class="rushtek-multiple w-full h-full pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline">
                        @foreach ($clients as $client)
                            <option value="{{ $client->user_id }}">{{ $client->lname }}, {{ $client->fname }}</option>
                        @endforeach
                    </select>
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

<script>
    $(document).ready(function (e) {
        $('#idProjectMembers').select2({
            placeholder: 'Select Project Members'
        });
    });
</script>