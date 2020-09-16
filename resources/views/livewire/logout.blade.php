<div x-data>
    <button @click.prevent="if (confirm('Are you sure?')) { $wire.logout() }" class="px-2 py-1 text-xs rounded font-semibold text-gray-300 transition duration-500 hover:bg-primary-400 hover:text-gray-100">
        Log out
    </button>
</div>
