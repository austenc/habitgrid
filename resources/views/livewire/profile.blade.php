<div>
    <x-slot name="title">Your Profile</x-slot> 
    <div class="mt-8">
        <x-card>
            <form wire:submit.prevent="save">
                <div class="md:flex space-y-4 md:space-y-0">
                    <div class="md:w-1/3 space-y-1 border-b border-gray-200 md:border-0">
                        <div class="text-lg font-semibold">
                            Information
                        </div>
                        <div class="text-gray-500 text-opacity-75 pb-2 text-sm">Your personal information</div>
                    </div>
                    <div class="md:w-2/3 space-y-3">
                        <div class="space-y-3 lg:space-y-0 lg:flex lg:space-x-3">
                            <div class="flex-1">
                                <x-input name="user.name" wire:model.defer="user.name" label="Your Name" />
                            </div>
                            <div class="flex-1">
                                <x-input name="user.email" wire:model.defer="user.email" label="Email" />
                            </div>
                        </div>
                        <div class="mt-3">
                            <x-textarea name="user.bio" wire:model.defer="user.bio" label="Bio" />
                        </div>
                    </div>
                </div>
                <div class="md:flex space-y-4 md:space-y-0 border-t border-gray-200 border-opacity-50 mt-6 pt-6">
                    <div class="md:w-1/3 space-y-1 pb-2 border-b border-gray-200 md:border-0">
                        <div class="text-lg font-semibold">
                            Profile Photo
                        </div>
                    </div>
                    <div class="md:w-2/3 space-y-3">
                        <div class="space-y-3 lg:space-y-0 lg:flex lg:items-center lg:space-x-3">
                            <div class="flex-1 text-right">
                                <div class="w-12 h-12">
                                    <span class="bg-gray-700 shadow w-10 h-10 rounded-full text-gray-500 transition duration-300 hover:text-gray-300">
                                        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <x-input name="upload" label="Upload photo" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right border-t border-gray-200 border-opacity-50 mt-3 pt-3">
                    <button class="px-3 py-2 text-white rounded bg-primary-700 hover:bg-primary-500">
                        Save
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</div>
