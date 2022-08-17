<x-app-layout>
    @if ($message = Session::get('alert'))
          <x-alert  />
    @endif
    <div class="overflow-x-auto">
    <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-3/6 m-6">
        <h1 class="text-3xl mx-2 font-bold leading-tight">Project: {{$project->name}}</h1>
        <span class="flex items-center space-x-4">
            <h1 class="text-5xl font-bold leading-tight">Update Task</h1>
            <a href="{{ route('tasks',$project->id) }}" class="btn bg-green-700 text-white font-bold rounded-full px-3 py-1 my-2 
            focus:outline-none hover:bg-green-800">
                Return
            </a>
        </span>
        <div class="flex flex-col">
        <div class="bg-white shadow-md p-5">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" autocomplete="off" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mt-4">
                    <x-label :value="__('Name')" />

                    <input value="{{$task->name}}" type="text" name="name" id="idName" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline @if(Auth::user()->role ==  2 || Auth::user()->role == 3)bg-gray-200 @endif" required @if (Auth::user()->role ==  2 || Auth::user()->role == 3) disabled @endif>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Description')" />

                    <textarea id="message" name="text" rows="8" class="block w-full text-gray-900 rounded-lg border border-gray-500 @if(Auth::user()->role == 3 || (Auth::user()->role == 2 && !in_array(Auth::user()->id,$members)))bg-gray-200 @endif" placeholder="Your message..." @if ((Auth::user()->role == 2 && !in_array(Auth::user()->id,$members)) || Auth::user()->role == 3) disabled @endif>{{$task->text}}</textarea>

                </div>

                <div class="mt-4">
                    <x-label :value="__('Task Members')" />
    
                    <select name="taskMembers[]" id="idTaskMembers" class="rushtek-multiple w-full h-full pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline @if(Auth::user()->role ==  2 || Auth::user()->role == 3)bg-gray-200 @endif" multiple="multiple"  @if (Auth::user()->role ==  2 || Auth::user()->role == 3) disabled @endif>
                        @foreach ($project_members as $project_member)
                            <option value="{{ $project_member->user_id }}" @if (in_array($project_member->user_id,$members)) selected @endif>{{ $project_member->lname }}, {{ $project_member->fname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <x-label :value="__('Start Date')" />
                    <input value="{{$project->start_date}}" min="{{$project->start_date}}" max="{{$project->end_date}}" type="date" name="start_date" id="idStartDate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline @if(Auth::user()->role ==  2 || Auth::user()->role == 3)bg-gray-200 @endif" @if (Auth::user()->role ==  2 || Auth::user()->role == 3) disabled @endif>
                </div>

                <div class="mt-4">
                    <x-label :value="__('End Date')" />
                    <input value="{{$project->end_date}}" min="{{$project->start_date}}" max="{{$project->end_date}}" type="date" name="end_date" id="idEndDate" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline @if(Auth::user()->role ==  2 || Auth::user()->role == 3)bg-gray-200 @endif" @if (Auth::user()->role ==  2 || Auth::user()->role == 3) disabled @endif>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Status')" />
    
                    <select name="status" id="status" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline  @if(Auth::user()->role == 3)bg-gray-200 @endif" @if ((Auth::user()->role == 2 && !in_array(Auth::user()->id,$members)) || Auth::user()->role == 3) disabled @endif>
                        <option value="1" @if($task->status == 1) selected @endif>Todo</option>
                        <option value="2" @if($task->status == 2) selected @endif>Work in Progress</option>
                        <option value="3" @if($task->status == 3) selected @endif>Finish</option>
                    </select>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Progress: '.$task->progress.'%')" id="idLblProgress"/>
    
                    <input type="range" min="0" max="100" value="{{$task->progress}}" step="5" name="progress" id="idProgress" class="w-full text-base placeholder-gray-600 border rounded-lg apperance-none focus:shadow-outline" oninput="showProgress(this.value)" @if (Auth::user()->role == 3 || (Auth::user()->role == 2 && !in_array(Auth::user()->id,$members))) disabled @endif>
                </div>
    
                <div class="mt-4">
                    <x-label :value="__('Cost')" />
    
                    <input value="{{$task->cost}}" type="number" min="0" name="cost" id="idCost" class="w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline @if((Auth::user()->role == 2 && !in_array(Auth::user()->id,$members)) || Auth::user()->role == 3)bg-gray-200 @endif" @if (Auth::user()->role == 3 || (Auth::user()->role == 2 && !in_array(Auth::user()->id,$members))) disabled @endif>
                </div>
    
                @if (Auth::user()->role == 1 || (Auth::user()->role == 2 && in_array(Auth::user()->id,$members)))
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-3" onclick="return confirm('Are you sure to update task?')">
                        {{ __('Update Task') }}
                    </x-button>
                </div>
                @endif
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