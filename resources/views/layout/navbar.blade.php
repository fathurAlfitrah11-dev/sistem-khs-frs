@yield('title')

<div class="h-16 bg-[#3b3f63] flex items-center justify-end px-6 border-b border-white/10">

    {{-- USER --}}
    <div class="flex items-center gap-3">

        <div class="text-right">
            <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-400">{{ Auth::user()->role }}</p>
        </div>

        <div class="w-9 h-9 rounded-full bg-[#2d3250] flex items-center justify-center">
            👤
        </div>

    </div>

</div>