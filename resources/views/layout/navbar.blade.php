<div
    class="h-16 bg-[#e4ecff] fixed top-0 left-64 right-0 z-50 flex items-center justify-between px-6 border-b border-[#cbd5e1] shadow-sm">

    {{-- PAGE TITLE --}}
    <div>
        <h1 class="text-lg font-semibold text-slate-800">
            @yield('title')
        </h1>

        <p class="text-xs text-slate-500">
            Dashboard Overview
        </p>
    </div>

    {{-- USER --}}
    <div class="flex items-center gap-3">

        <div class="text-right">
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