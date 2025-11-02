<div class="min-h-screen p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] shadow-lg">
                    <i class="fas fa-tv text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Rumah Sakit Sehat Selalu</h1>
                    <p class="text-sm text-gray-600">Pantau Antrian Semua Loket</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500 uppercase tracking-wide">Waktu</div>
                <div class="text-2xl font-bold text-gray-800 tabular-nums">{{ now()->format('H:i:s') }}</div>
                <div class="text-xs text-gray-500">{{ now()->format('d M Y') }}</div>
            </div>
        </div>
    </div>

    @if($error)
        <div class="mb-6 max-w-7xl mx-auto bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                <p class="text-red-800">{{ $error }}</p>
            </div>
        </div>
    @endif

    <!-- Grid Loket -->
    <div wire:poll.{{ config('api.poll_ms', 3000) }}ms="refresh" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 max-w-7xl mx-auto">
        @forelse($items as $row)
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-shadow">
                @include('livewire.display.partials.current-ticket', [
                    'ticket' => $row['current'] ?? null,
                    'loket' => $row['loket'] ?? null,
                    'compact' => true,
                ])
                @include('livewire.display.partials.next-ticket-list', [
                    'tickets' => $row['next'] ?? [],
                ])
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl shadow-xl border border-gray-100 p-12 text-center">
                <i class="fas fa-info-circle text-5xl text-gray-300 mb-4"></i>
                <p class="text-lg text-gray-500">Tidak ada data antrian.</p>
            </div>
        @endforelse
    </div>

    <!-- Auto Refresh Indicator -->
    <div class="fixed bottom-6 right-6 bg-white rounded-full shadow-lg px-4 py-2 border border-gray-200">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>Auto Refresh</span>
        </div>
    </div>
</div>
