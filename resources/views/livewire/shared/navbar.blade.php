<nav class="bg-white border-b border-gray-100 shadow-sm">
    <div class="px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Page Title / Breadcrumb Area -->
            <div>
                <h2 class="text-xl font-bold text-gray-800">Q-Medis Admin</h2>
            </div>

            <!-- User Profile Menu -->
            @if(session('access_token') && $user)
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-50 focus:outline-none transition-colors">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-800">{{ $user['name'] ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ $user['email'] ?? '' }}</p>
                        </div>
                        @if(!empty($user['avatar']))
                            <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}" class="w-10 h-10 rounded-full object-cover shadow-md">
                        @else
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] flex items-center justify-center text-white font-bold shadow-md">
                                {{ strtoupper(substr($user['name'] ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                        <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50" style="display: none;" x-cloak>
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">{{ $user['name'] ?? 'User' }}</p>
                            <p class="text-xs text-gray-500">{{ $user['email'] ?? '' }}</p>
                        </div>
                        <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-user text-gray-400 w-4"></i>
                            <span>Profil Saya</span>
                        </a>
                        <hr class="my-2 border-gray-100">
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('auth.login') }}" class="px-6 py-2.5 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl transition-all">
                    Masuk
                </a>
            @endif
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

