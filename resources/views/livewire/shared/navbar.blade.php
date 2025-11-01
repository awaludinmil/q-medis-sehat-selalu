<nav class="navbar-surface">
    <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8 overflow-x-auto">
        <div class="flex h-14 items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="/" class="text-lg font-semibold">Q-Medis</a>
            </div>
            <div class="flex items-center gap-3">
                @if(session('access_token'))
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button class="btn-secondary px-3 py-1.5">Logout</button>
                    </form>
                @else
                    <a href="{{ route('auth.login') }}" class="btn-primary px-3 py-1.5">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>

