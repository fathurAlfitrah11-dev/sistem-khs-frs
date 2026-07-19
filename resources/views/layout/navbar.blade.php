<div
    class="h-16 bg-[#e4ecff] sticky top-0 z-30 flex items-center justify-between px-4 md:px-6 border-b border-[#cbd5e1] shadow-sm">

    {{-- PAGE TITLE --}}
    <div class="flex items-center gap-4">

    <button
        id="menuButton"
        class="lg:hidden text-xl text-slate-700">

        <i class="fa-solid fa-bars"></i>

    </button>

    <div>
        <h1 class="text-lg font-semibold text-slate-800">
            @yield('title')
        </h1>

        <p class="text-xs text-slate-500">
            Dashboard Overview
        </p>
    </div>

</div>

    {{-- USER --}}
    <div class="flex items-center gap-2 md:gap-3">

        <div class="text-right hidden sm:block">
            <p class="text-sm font-medium text-slate-800">
                {{ Auth::user()->name }}
            </p>

            <p class="text-xs text-slate-500">
                {{ Auth::user()->role }}
            </p>
        </div>

        <div class="w-9 h-9 rounded-full bg-[#1e254c]/10 flex items-center justify-center text-slate-700">
            👤
        </div>

    </div>

</div>