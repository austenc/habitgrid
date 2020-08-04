<div>
   <div x-data="{ editing: false }">
       <div class="md:flex md:space-x-3 items-center">
           <h1 class="text-3xl font-semibold">{{ $habit->name }}</h1>
           <x-streak-badge :habit="$habit" />
           <div class="flex-grow">
               <div class="mt-4 md:mt-0 flex items-center flex-row-reverse md:flex-row justify-between md:flex-1">
                   <button @click.prevent="editing = !editing" type="button" x-text="editing ? 'Cancel' : 'Edit'" class="block text-sm p-1 uppercase font-semibold tracking-wide text-link">Edit</button>
                   <a href="{{ route('habits.index') }}" class="text-link">Back to all habits</a>
               </div>
           </div>
       </div>
       <div x-show="editing" x-cloak
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0 transform scale-90"
           x-transition:enter-end="opacity-100 transform scale-100"
           x-transition:leave="transition ease-in duration-300"
           x-transition:leave-start="opacity-100 transform scale-100"
           x-transition:leave-end="opacity-0 transform scale-90"
       >
           <x-habit-form :habit="$habit" :action="route('habits.update', $habit)" method="PUT" />
       </div>
   </div>

   <div class="mt-6">
       <livewire:day-grid :habit="$habit" /> 
   </div> 

   <div class="my-10">
       <h2 class="text-gray-400 font-semibold text-xl text-center">Recent Entries</h2>
   </div>
   
   <livewire:week-view :habit="$habit" />
</div>
