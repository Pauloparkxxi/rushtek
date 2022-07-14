<x-app-layout>
    @if ($message = Session::get('alert'))
          <x-alert  />
    @endif
    
    <div class="py-3">
        <div class="max-w-6xl mx-auto">
            <div class="m-2 flex flex-wrap justify-between items-center">
                <span class="flex flex-wrap items-center">
                    <h1 class="text-5xl mx-2 font-bold leading-tight">Reports</h1>
                </span>
            </div>
            <div class="justify-evenly px-2">
            </div>
        </div>
    </div>
</x-app-layout>