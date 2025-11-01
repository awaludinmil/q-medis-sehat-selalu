@php
    $loketName = data_get($loket, 'nama_loket') ?? data_get($loket, 'name') ?? data_get($loket, 'nama') ?? data_get($loket, 'label') ?? 'Loket';
    $number = data_get($ticket, 'nomor_antrian') ?? data_get($ticket, 'queue_number') ?? data_get($ticket, 'number') ?? data_get($ticket, 'no') ?? data_get($ticket, 'code') ?? '-';
    $subtitle = data_get($ticket, 'subtitle') ?? data_get($ticket, 'patient_name') ?? data_get($ticket, 'name');
@endphp

<div class="bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] p-6">
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center gap-2">
            <i class="fas fa-door-open text-white/80"></i>
            <span class="text-sm font-semibold text-white/90 uppercase tracking-wide">{{ $loketName }}</span>
        </div>
        <div class="text-right">
            <div class="text-xs text-white/70">Update</div>
            <div class="text-xs text-white/90 font-mono tabular-nums">{{ now()->format('H:i:s') }}</div>
        </div>
    </div>
    
    <div class="text-center py-4">
        <div class="text-xs text-white/70 uppercase tracking-wide mb-2">Sedang Dilayani</div>
        <div class="text-6xl font-extrabold text-white tabular-nums drop-shadow-lg">{{ $number }}</div>
        @if($subtitle)
            <div class="text-sm text-white/90 mt-3 font-medium">{{ $subtitle }}</div>
        @endif
    </div>
</div>
