<!doctype html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Q-Medis Admin' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="h-full bg-gray-100">
    <div class="flex h-full">
        <!-- Sidebar -->
        @livewire('shared.sidebar')
        
        <!-- Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            @livewire('shared.navbar')
            
            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
            
            <!-- Footer -->
            @livewire('shared.footer')
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a id="scrollTop" class="fixed bottom-10 right-10 hidden w-12 h-12 rounded-full bg-gradient-to-br from-[rgb(var(--qm-primary))] to-[rgb(var(--qm-accent))] text-white shadow-lg hover:shadow-xl transition-all duration-200 items-center justify-center cursor-pointer" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to top button
            const scrollBtn = document.getElementById('scrollTop');
            if (scrollBtn) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 100) {
                        scrollBtn.classList.remove('hidden');
                        scrollBtn.classList.add('flex');
                    } else {
                        scrollBtn.classList.add('hidden');
                        scrollBtn.classList.remove('flex');
                    }
                });
                scrollBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        });
    </script>
</body>
</html>

