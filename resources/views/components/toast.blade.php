<div x-cloak x-data="toast()"
    x-show="open"
    @toast.window="onToast($event.detail)"
    :class="classes()"
    class="px-5 py-3 mb-8 mr-8 border-l-4 border-opacity-75 rounded shadow-lg fixed right-0 bottom-0 z-50 inset"
    x-transition:enter="transition transform ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90 translate-x-full"
    x-transition:enter-end="opacity-100 scale-100 translate-x-0"
    x-transition:leave="transition transform ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
>
    <span x-text="message"></span>
</div>
<script>
    let toast = () => {
        return {
            open: false,
            message: '',
            onToast(data) {
                if (this.open) {
                    return false;
                }

                this.open = true
                this.message = data.message
                this.type = data.type ?? 'success'
                
                setTimeout(() => {
                    this.open = false
                }, data.duration ?? 4000)
            },
            classes() {
                return {
                    'bg-primary-50 border-primary-500 text-primary-700': this.type === 'info',
                    'bg-teal-50 border-teal-500 text-teal-700': this.type === 'success',
                    'bg-pink-50 border-pink-500 text-pink-700': this.type === 'error',
                }
            }
        }
    }
</script>
