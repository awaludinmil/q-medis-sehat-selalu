<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Q-Medis - Login' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
</head>
<body class="h-full hospital-bg text-gray-900">
    <div class="min-h-screen">
        <main>
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
