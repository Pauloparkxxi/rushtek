<x-app-layout>
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <h1 class="text-3xl mx-2 font-bold leading-tight">Project: {{$project->name}}</h1>
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Add Task</h1>
            <a href="{{ route('tasks',$project->id) }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('tasks.store', $project->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="mt-4">
                    <x-label :value="__('Name')" />

                    <input value="" type="text" name="name" id="idName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline" required>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Description')" />

                    <textarea id="message" name="description" rows="8" class="block w-full text-gray-900 rounded-lg border border-gray-500" placeholder="Your message..." required></textarea>

                </div>

                <div class="mt-4">
                    <x-label :value="__('Project Members')" />
    
                    <select name="projectMembers[]" id="idProjectMembers" class="rushtek-multiple w-full h-full pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline" multiple="multiple">
                        @foreach ($project_members as $member)
                            <option value="{{ $member->user_id }}">{{ $member->lname }}, {{ $member->fname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Start Date')" />
                    <input value="{{$project->start_date}}" min="{{$project->start_date}}" max="{{$project->end_date}}" type="date" name="start_date" id="idStartDate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>

                <div class="mt-4">
                    <x-label :value="__('End Date')" />
                    <input value="{{$project->end_date}}" min="{{$project->start_date}}" max="{{$project->end_date}}" type="date" name="end_date" id="idEndDate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Status')" />
    
                    <select name="status" id="status" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline">
                        <option value="1">Todo</option>
                        <option value="2">Work in Progress</option>
                        <option value="3">Finish</option>
                    </select>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Progress: 0%')" id="idLblProgress"/>
    
                    <input type="range" min="0" max="100" value="0" step="5" name="progress" id="idProgress" class="w-full text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline" oninput="showProgress(this.value)">
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Cost')" />
    
                    <input value="0" type="number" min="0" name="cost" id="idCost" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline">
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" onclick="return confirm('Are you sure to add?')">
                        {{ __('Add Task') }}
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
    function showProgress(progress) {
        $('#idLblProgress').text('Progress: '+progress+"%");
    }
</script>