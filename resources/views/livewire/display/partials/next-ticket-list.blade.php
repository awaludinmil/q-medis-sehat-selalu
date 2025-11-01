<div class="p-6">
    <div class="flex items-center gap-2 mb-3">
        <i class="fas fa-list text-gray-400 text-sm"></i>
        <div class="text-xs font-bold uppercase tracking-wide text-gray-500">Antrian Berikutnya</div>
    </div>
    <div class="space-y-2">
        @forelse($tickets as $t)
            @php
                $num = data_get($t, 'nomor_antrian') ?? data_get($t, 'queue_number') ?? data_get($t, 'number') ?? data_get($t, 'no') ?? data_get($t, 'code') ?? '-';
                $note = data_get($t, 'subtitle') ?? data_get($t, 'patient_name') ?? data_get($t, 'name');
            @endphp
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 rounded-lg border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <i class="fas fa-user text-xs text-gray-600"></i>
                    </div>
                    <div class="text-2xl font-bold tabular-nums text-gray-800">{{ $num }}</div>
                </div>
                @if($note)
                    <div class="text-sm text-gray-600 font-medium">{{ $note }}</div>
                @endif
            </div>
        @empty
            <div class="px-4 py-6 text-center bg-gray-50 rounded-lg border border-gray-100">
                <i class="fas fa-inbox text-2xl text-gray-300 mb-2"></i>
                <div class="text-sm text-gray-500">Tidak ada antrian</div>
            </div>
        @endforelse
    </div>
</div>
