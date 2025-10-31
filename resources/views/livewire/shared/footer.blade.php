<footer class="mt-8 border-t border-gray-200 bg-white/60 py-4 text-sm text-gray-600 backdrop-blur dark:border-gray-800 dark:bg-gray-900/40 dark:text-gray-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div>© {{ date('Y') }} Q-Medis</div>
        <div class="flex items-center gap-4">
            <a href="{{ route('display.overview') }}" class="hover:underline">Display</a>
            @if(session('access_token'))
                <a href="{{ route('admin.users') }}" class="hover:underline">Admin</a>
            @else
                <a href="{{ route('auth.login') }}" class="hover:underline">Login</a>
            @endif
        </div>
    </div>
</footer>
