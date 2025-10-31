<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Q-Medis' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
<body class="h-full bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-white">
<div class="min-h-screen">
    @livewire('shared.navbar')
    <main class="p-6">
        @yield('content')
    </main>
    @livewire('shared.footer')
</div>
@livewireScripts
</body>
</html>
