@php
    $loketName = data_get($loket, 'name') ?? data_get($loket, 'nama') ?? data_get($loket, 'label') ?? 'Loket';
    $number = data_get($ticket, 'queue_number') ?? data_get($ticket, 'number') ?? data_get($ticket, 'no') ?? data_get($ticket, 'code') ?? '-';
    $subtitle = data_get($ticket, 'subtitle') ?? data_get($ticket, 'patient_name') ?? data_get($ticket, 'name');
@endphp

<div class="current-wrap">
    <div>
        <div class="qm-section-title">{{ $loketName }}</div>
        <div class="mt-1 digit-xxl accent-primary">{{ $number }}</div>
        @if($subtitle)
            <div class="current-sub">{{ $subtitle }}</div>
        @endif
    </div>
    <div class="text-right text-xs text-gray-400">
        <div>Terakhir diperbarui</div>
        <div class="tabular-nums">{{ now()->format('H:i:s') }}</div>
    </div>
</div>
