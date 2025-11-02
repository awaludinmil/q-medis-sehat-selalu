@php
    $loketName = data_get($loket, 'nama_loket') ?? data_get($loket, 'name') ?? data_get($loket, 'nama') ?? data_get($loket, 'label') ?? 'Loket';
    $number = data_get($ticket, 'nomor_antrian') ?? data_get($ticket, 'queue_number') ?? data_get($ticket, 'number') ?? data_get($ticket, 'no') ?? data_get($ticket, 'code') ?? '-';
    $subtitle = data_get($ticket, 'subtitle') ?? data_get($ticket, 'patient_name') ?? data_get($ticket, 'name');
@endphp

<div class="bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] p-6" style="container-type: size; min-height: {{ (isset($compact) && $compact) ? 'clamp(10rem, 32cqw, 18rem)' : 'clamp(12rem, 40cqw, 20rem)' }};">
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center gap-2">
            <i class="fas fa-door-open text-white/80"></i>
            <span class="text-2xl md:text-3xl font-semibold text-white/90 uppercase tracking-wide">{{ $loketName }}</span>
        </div>
        <div class="text-right">
            <div class="text-xs text-white/70">Update</div>
            <div class="text-xs text-white/90 font-mono tabular-nums"><span class="js-clock" data-format="time"></span></div>
        </div>
    </div>
    
    <div class="text-center py-8 md:py-10">
        <div class="text-xs text-white/70 uppercase tracking-wide mb-2">Sedang Dilayani</div>
        <div class="font-extrabold text-white tabular-nums drop-shadow-lg leading-none whitespace-nowrap overflow-hidden" style="font-size: {{ (isset($compact) && $compact) ? 'clamp(6rem, min(30cqw, 26cqh), 18rem)' : 'clamp(7rem, min(34cqw, 30cqh), 22rem)' }}; letter-spacing: -0.02em;">{{ $number }}</div>
        @if($subtitle)
            <div class="text-sm text-white/90 mt-3 font-medium">{{ $subtitle }}</div>
        @endif
    </div>
</div>
