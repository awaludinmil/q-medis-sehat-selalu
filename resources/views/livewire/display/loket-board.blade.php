<div class="min-h-screen p-8">
    @php
        $loketName = data_get($loket, 'nama_loket') ?? data_get($loket, 'name') ?? data_get($loket, 'nama') ?? data_get($loket, 'label') ?? 'Loket';
    @endphp

    <div class="mb-8">
        <div class="flex items-center justify-between max-w-7xl mx-auto">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] shadow-lg">
                    <i class="fas fa-tv text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Rumah Sakit Sehat Selalu</h1>
                    <p class="text-sm text-gray-600">Pantau Antrian Loket {{ $loketName }}</p>
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

    <div wire:poll.{{ config('api.poll_ms', 3000) }}ms="refresh" class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-shadow">
            @include('livewire.display.partials.current-ticket', [
                'ticket' => $current ?? null,
                'loket' => $loket ?? null,
            ])
            @include('livewire.display.partials.next-ticket-list', [
                'tickets' => $next ?? [],
            ])
        </div>
    </div>
</div>
