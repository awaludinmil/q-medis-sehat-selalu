<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="h-full bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-8">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] p-8">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-search text-2xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-white/80 text-sm uppercase tracking-wider">Error</div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">404 • Halaman Tidak Ditemukan</h1>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <p class="text-gray-700 text-base md:text-lg">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
                <p class="text-gray-500 text-sm mt-2">Periksa kembali URL atau kembali ke halaman utama.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-5 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <a href="{{ route('display.overview') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-xl font-semibold shadow hover:shadow-md transition">
                        <i class="fas fa-tv mr-2"></i>
                        Ke Overview
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow hover:shadow-md transition">
                        <i class="fas fa-home mr-2"></i>
                        Ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
