@if($message)
    <div
        x-data="{
            show: true,
            progress: 100,
            startCountdown() {
                let interval = setInterval(() => {
                    this.progress -= 1;
                    if (this.progress <= 0) {
                        clearInterval(interval);
                        this.show = false;
                    }
                }, {{ $interval }});
            }
        }"
        x-init="startCountdown()"
        x-show="show"
        x-transition
        @class([
            'bg-green-100 border border-green-400 text-green-700' => $type === 'success',
            'bg-red-100 border border-red-400 text-red-700' => $type === 'error',
            'bg-blue-100 border border-blue-400 text-blue-700' => $type === 'info',
            'bg-yellow-100 border border-yellow-400 text-yellow-700' => $type === 'warning',
            'px-4 py-3 rounded mb-4 relative overflow-hidden'
        ])
    >
        <div
            class="absolute bottom-0 left-0 h-1"
            :class="{
                'bg-green-400': '{{ $type }}' === 'success',
                'bg-red-400': '{{ $type }}' === 'error',
                'bg-blue-400': '{{ $type }}' === 'info',
                'bg-yellow-400': '{{ $type }}' === 'warning'
            }"
            :style="`width: ${progress}%`"
        ></div>

        {{ $message }}

        <button
            @click="show = false"
            class="absolute top-1 right-1 hover:opacity-70"
            :class="{
                'text-green-600': '{{ $type }}' === 'success',
                'text-red-600': '{{ $type }}' === 'error',
                'text-blue-600': '{{ $type }}' === 'info',
                'text-yellow-600': '{{ $type }}' === 'warning'
            }"
        >
            &times;
        </button>
    </div>
@endif
