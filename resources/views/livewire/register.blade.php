<div class="mx-auto max-w-lg">
    <h1 class="mt-8 mb-3 font-extrabold text-gray-400 text-center text-xl">Register an Account</h1>
    <x-form wire:submit.prevent="register">
        <x-card>
            <div class="">
                <x-input wire:model="name" name="name" label="Your Name" placeholder="Joe Schmo" />
            </div>
            <div class="mt-2">
                <x-input wire:model="email" name="email" label="Email" placeholder="joe@schmo.example.com" />
            </div>
            <div class="mt-2">
                <x-input wire:model="password" type="password" name="password" label="Password" placeholder="Password" />
            </div>
            <div class="mt-2">
                <x-input wire:model="password_confirmation" type="password" name="password_confirmation" label="Confirm Password" placeholder="Confirm Password" />
            </div>
            <div class="mt-3 text-right">
                <button type="submit" class="bg-primary-500 hover:bg-primary-700 rounded px-3 py-2 text-white font-semibold text-sm">
                    Register
                </button>
            </div>
        </x-card>
    </x-form>
</div>