<aside class="w-64 bg-gradient-to-b from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] min-h-screen flex flex-col shadow-xl">
    @php
        $isActive = function ($patterns) {
            $patterns = (array) $patterns;
            return request()->routeIs(...$patterns);
        };
    @endphp

    <!-- Sidebar Brand -->
    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center h-20 text-white no-underline border-b border-white/15 hover:bg-white/5 transition-all">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-hospital-user text-xl text-white"></i>
            </div>
            <span class="text-xl font-bold">Q-Medis</span>
        </div>
    </a>

    <!-- Sidebar Menu -->
    <nav class="flex-1 py-6 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 mb-1 text-white/90 hover:bg-white/15 hover:text-white transition-all {{ $isActive('admin.dashboard') ? 'bg-white/20 font-semibold text-white border-l-4 border-white' : '' }}">
            <i class="fas fa-tachometer-alt w-5 text-lg"></i>
            <span class="ml-3 text-sm">Dashboard</span>
        </a>

        <!-- Divider -->
        <div class="my-4 px-6">
            <div class="border-t border-white/15"></div>
        </div>

        <!-- Section Heading -->
        <div class="px-6 py-2 text-xs font-bold text-white/50 uppercase tracking-wider">
            Kelola Data
        </div>

        <!-- Users (Admin Only) -->
        @if($user && ($user['role'] ?? '') === 'admin')
            <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 mb-1 text-white/90 hover:bg-white/15 hover:text-white transition-all {{ $isActive(['admin.users']) ? 'bg-white/20 font-semibold text-white border-l-4 border-white' : '' }}">
                <i class="fas fa-users w-5 text-lg"></i>
                <span class="ml-3 text-sm">Users / Petugas</span>
            </a>
        @endif

        <!-- Loket (Read-only for Petugas) -->
        <a href="{{ route('admin.lokets') }}" class="flex items-center px-6 py-3 mb-1 text-white/90 hover:bg-white/15 hover:text-white transition-all {{ $isActive(['admin.lokets']) ? 'bg-white/20 font-semibold text-white border-l-4 border-white' : '' }}">
            <i class="fas fa-door-open w-5 text-lg"></i>
            <span class="ml-3 text-sm">Loket</span>
        </a>

        <!-- Antrian -->
        <a href="{{ route('admin.antrians') }}" class="flex items-center px-6 py-3 mb-1 text-white/90 hover:bg-white/15 hover:text-white transition-all {{ $isActive(['admin.antrians']) ? 'bg-white/20 font-semibold text-white border-l-4 border-white' : '' }}">
            <i class="fas fa-list-ol w-5 text-lg"></i>
            <span class="ml-3 text-sm">Antrian</span>
        </a>

        <!-- Divider -->
        <div class="my-4 px-6">
            <div class="border-t border-white/15"></div>
        </div>

        <!-- Section Heading -->
        <div class="px-6 py-2 text-xs font-bold text-white/50 uppercase tracking-wider">
            Display
        </div>

        <!-- Kiosk -->
        <a href="{{ route('display.kiosk') }}" class="flex items-center px-6 py-3 mb-1 text-white/90 hover:bg-white/15 hover:text-white transition-all {{ $isActive('display.kiosk') ? 'bg-white/20 font-semibold text-white border-l-4 border-white' : '' }}">
            <i class="fas fa-desktop w-5 text-lg"></i>
            <span class="ml-3 text-sm">Kiosk (Ambil Nomor)</span>
        </a>

        <!-- Overview -->
        <a href="{{ route('display.overview') }}" class="flex items-center px-6 py-3 mb-1 text-white/90 hover:bg-white/15 hover:text-white transition-all {{ $isActive('display.overview') ? 'bg-white/20 font-semibold text-white border-l-4 border-white' : '' }}">
            <i class="fas fa-tv w-5 text-lg"></i>
            <span class="ml-3 text-sm">Overview Board</span>
        </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-white/15">
        <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
            <p class="text-xs text-white/70 text-center">© 2024 Q-Medis</p>
            <p class="text-xs text-white/50 text-center mt-1">v1.0.0</p>
        </div>
    </div>
</aside>
