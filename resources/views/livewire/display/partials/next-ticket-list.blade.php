<div class="mt-6">
    <div class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Berikutnya</div>
    <div class="mt-2 divide-y divide-gray-200 rounded-md border border-gray-200 dark:divide-gray-700 dark:border-gray-700">
        @forelse($tickets as $t)
            @php
                $num = data_get($t, 'queue_number') ?? data_get($t, 'number') ?? data_get($t, 'no') ?? data_get($t, 'code') ?? '-';
                $note = data_get($t, 'subtitle') ?? data_get($t, 'patient_name') ?? data_get($t, 'name');
            @endphp
            <div class="flex items-center justify-between px-4 py-3">
                <div class="text-xl font-semibold tabular-nums">{{ $num }}</div>
                @if($note)
                    <div class="text-sm text-gray-600 dark:text-gray-300">{{ $note }}</div>
                @endif
            </div>
        @empty
            <div class="px-4 py-3 text-sm text-gray-500">-</div>
        @endforelse
    </div>
</div>
