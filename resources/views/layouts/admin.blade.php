<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Q-Medis Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
<body class="h-full bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-white">
<div class="min-h-screen">
    @livewire('shared.navbar')

    <main class="p-6">
        <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-4 lg:col-span-3">
                    @livewire('shared.sidebar')
                </div>
                <div class="col-span-8 lg:col-span-9 min-w-0">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    @livewire('shared.footer')
</div>
@livewireScripts
</body>
</html>
