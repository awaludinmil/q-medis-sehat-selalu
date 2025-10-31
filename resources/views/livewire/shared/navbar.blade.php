<nav class="bg-white/80 backdrop-blur border-b border-gray-200 dark:bg-gray-900/60 dark:border-gray-800">
    <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8 overflow-x-auto">
        <div class="flex h-14 items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="/" class="text-lg font-semibold">Q-Medis</a>
            </div>
            <div class="flex items-center gap-3">
                @if(session('access_token'))
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('auth.login') }}" class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>

