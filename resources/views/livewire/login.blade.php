<div class="mx-auto max-w-lg">
    <h1 class="mt-8 mb-3 font-extrabold text-gray-400 text-center text-xl">Sign In</h1>
    <x-form wire:submit.prevent="login">
        <x-card>
            <div class="">
                <x-input wire:model="email" name="email" label="Email" placeholder="jerry@example.com" />
            </div>
            <div class="mt-2">
                <x-input wire:model="password" type="password" name="password" label="Password" placeholder="Password" />
            </div>
            <div class="mt-3 text-right">
                <button type="submit" class="bg-primary-500 hover:bg-primary-700 rounded px-3 py-2 text-white font-semibold text-sm">
                    Sign In
                </button>
            </div>
        </x-card>
        <div class="text-center mt-5">
            Need account? <a href="{{ route('register') }}" class="text-link font-medium">Sign up here</a>
        </div>
    </x-form>
</div>