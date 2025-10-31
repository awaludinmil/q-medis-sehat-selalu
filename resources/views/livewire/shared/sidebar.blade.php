<aside class="w-full flex-shrink-0">
    <div class="sticky top-14 lg:h-[calc(100vh-56px)] overflow-y-auto border-b lg:border-b-0 lg:border-r border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="p-4 border-b border-gray-100 dark:border-gray-800">
            <div class="text-lg font-semibold">Panel</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Admin & Petugas</div>
        </div>

        <nav class="p-2" role="navigation" aria-label="Sidebar">
            @php
                $isActive = function ($patterns) {
                    $patterns = (array) $patterns;
                    return request()->routeIs(...$patterns);
                };
                $navClass = function (bool $active) {
                    $base = 'block rounded-md px-3 py-2 text-sm transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-offset-gray-900';
                    return $active
                        ? $base.' bg-gray-100 text-gray-900 dark:bg-gray-800 dark:text-white'
                        : $base.' text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800/60';
                };
            @endphp

            <ul role="list" class="space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ $navClass($isActive('admin.dashboard')) }}"
                       @if($isActive('admin.dashboard')) aria-current="page" @endif>Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}"
                       class="{{ $navClass($isActive(['admin.users'])) }}"
                       @if($isActive(['admin.users'])) aria-current="page" @endif>Users / Petugas</a>
                </li>
                <li>
                    <a href="{{ route('admin.lokets') }}"
                       class="{{ $navClass($isActive(['admin.lokets'])) }}"
                       @if($isActive(['admin.lokets'])) aria-current="page" @endif>Loket</a>
                </li>
                <li>
                    <a href="{{ route('admin.antrians') }}"
                       class="{{ $navClass($isActive(['admin.antrians'])) }}"
                       @if($isActive(['admin.antrians'])) aria-current="page" @endif>Antrian</a>
                </li>
            </ul>

            <div class="mt-4 border-t border-gray-200 pt-2 dark:border-gray-800"></div>
            <div class="px-3 pb-1 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Display</div>
            <ul role="list" class="space-y-1">
                <li>
                    <a href="{{ route('display.kiosk') }}" class="{{ $navClass($isActive('display.kiosk')) }}">Kiosk (Ambil Nomor)</a>
                </li>
                <li>
                    <a href="{{ route('display.overview') }}" class="{{ $navClass($isActive('display.overview')) }}">Overview</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
