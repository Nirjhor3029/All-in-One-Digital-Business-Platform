<div
    x-data="{
        show: false,
        message: '',
        type: 'success',
        init() {
            @session('success')
                this.show = true;
                this.message = '{{ session('success') }}';
                this.type = 'success';
                setTimeout(() => this.show = false, 4000);
            @endsession
            @session('error')
                this.show = true;
                this.message = '{{ session('error') }}';
                this.type = 'error';
                setTimeout(() => this.show = false, 4000);
            @endsession
            @session('info')
                this.show = true;
                this.message = '{{ session('info') }}';
                this.type = 'info';
                setTimeout(() => this.show = false, 4000);
            @endsession
            @session('warning')
                this.show = true;
                this.message = '{{ session('warning') }}';
                this.type = 'warning';
                setTimeout(() => this.show = false, 4000);
            @endsession
        }
    }"
    x-on:toast.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 4000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-4 right-4 z-[100] max-w-sm"
    style="display: none;"
>
    <div :class="{
        'bg-success': type === 'success',
        'bg-danger': type === 'error',
        'bg-accent': type === 'info',
        'bg-highlight': type === 'warning'
    }" class="text-white px-5 py-3 rounded-card shadow-lg flex items-center gap-3">
        <span x-text="message" class="text-sm font-medium"></span>
        <button @click="show = false" class="text-white/80 hover:text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
