<div class="w-full transition-all py-2 md:py-0 md:h-16 bg-gray-800 text-gray-300">
    <div class="h-full" x-data="{ open: false }">
        <div class="container h-full">
            <div class="flex h-full items-center">
                <a href="{{ url('/') }}" class="font-extrabold text-gray-200 text-lg hover:text-white">
                    Habit Tracker
                </a>
    
                {{-- Menu button --}}
                <div class="h-full flex flex-grow items-center justify-end md:hidden">
                    <button @click.prevent="open = !open" type="button" class="w-8 h-8 md:hidden text-gray-400 hover:text-white">
                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
    
                {{-- Desktop menu --}}
                <div class="ml-5 hidden md:flex h-full flex-grow items-center justify-between md:space-x-6">
                    <div class="h-full flex space-x-6 items-center">
                        <x-nav-link :url="route('dashboard')">Dashboard</x-nav-link>
                        <x-nav-link :url="route('habits.index')">Habits</x-nav-link>
                    </div>
                    <a href="#profile" class="inline-flex items-center space-x-2">
                        <span class="bg-gray-700 shadow w-10 h-10 rounded-full text-gray-500 transition duration-300 hover:text-gray-300">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                        </span>
                        <div class="text-xs">
                            Austen
                        </div>
                    </a>
                </div>
    
                {{-- Guest view --}}
                {{-- <div class="ml-5 flex-grow flex items-center justify-end space-x-6">
                    <a href="#login" class="px-3 py-1 text-sm font-medium text-gray-300 hover:text-white">
                        Log In
                    </a>
                    <a href="#signup" class="px-3 py-1 text-sm font-medium border border-primary-500 text-primary-400 hover:bg-primary-400 hover:text-primary-100 rounded">
                        Sign Up
                    </a>
                </div> --}}
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-cloak
            x-show.transition.origin.top.left="open" 
            class="-mb-2 mt-2 md:hidden divide-y border-t border-gray-700 border-opacity-25 flex flex-col divide-gray-700 divide-opacity-25"
        >
                <div>
                    <x-mobile-link url="#profile">
                        <span class="bg-gray-700 bg-opacity-75 text-opacity-75 shadow w-5 h-5 rounded-full text-gray-500 transition duration-300 hover:text-gray-300">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                        </span>
                        <div class="ml-2 text-sm">
                            Austen
                        </div>
                    </x-mobile-link>
                </div>
                <div>
                    <x-mobile-link :url="route('dashboard')">Dashboard</x-mobile-link>
                </div>
                <div>
                    <x-mobile-link :url="route('habits.index')">Habits</x-mobile-link>
                </div>
            </div>
        </div>
    </div>
</div>