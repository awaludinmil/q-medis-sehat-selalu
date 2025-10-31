<nav class="bg-white/80 backdrop-blur border-b border-gray-200 dark:bg-gray-900/60 dark:border-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-14 items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="/" class="text-lg font-semibold">Q-Medis</a>
                <a href="{{ route('display.overview') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Display</a>
                @if(session('access_token'))
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Users</a>
                    <a href="{{ route('admin.lokets') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Lokets</a>
                    <a href="{{ route('admin.antrians') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Antrians</a>
                @endif
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
