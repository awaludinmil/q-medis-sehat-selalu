<div class="min-h-screen p-6 text-gray-900 bg-white dark:bg-gray-900 dark:text-white">
    @if($error)
        <div class="mb-4 rounded-md bg-red-50 p-4 text-red-700 dark:bg-red-900/30 dark:text-red-200">
            {{ $error }}
        </div>
    @endif

    <div class="mx-auto max-w-5xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight">Ambil Nomor Antrian</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Pilih loket terlebih dahulu, lalu tekan tombol ambil nomor.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($lokets as $l)
                @php
                    $id = data_get($l, 'id') ?? data_get($l, 'loket_id') ?? null;
                    $name = data_get($l, 'name') ?? data_get($l, 'nama') ?? data_get($l, 'label') ?? ('Loket ' . $id);
                    $isActive = (string) $selected !== '' && (string) $selected === (string) $id;
                @endphp
                <button type="button"
                        wire:click="select({{ (int) $id }})"
                        class="rounded-lg border p-4 text-left shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 {{ $isActive ? 'border-blue-500 ring-1 ring-blue-500' : 'hover:bg-gray-50 dark:hover:bg-gray-800/70' }}">
                    <div class="text-sm text-gray-500 dark:text-gray-400">Loket</div>
                    <div class="mt-1 text-lg font-semibold">{{ $name }}</div>
                    @if($isActive)
                        <div class="mt-2 inline-block rounded bg-blue-600 px-2 py-0.5 text-xs text-white">Dipilih</div>
                    @endif
                </button>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 rounded-lg border border-gray-200 p-4 text-gray-500 dark:border-gray-700">Tidak ada loket tersedia.</div>
            @endforelse
        </div>

        <div class="mt-6 flex flex-wrap items-center gap-3">
            <button type="button"
                    wire:click="ambilNomor"
                    @disabled(!$selected)
                    class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60">
                @if($loading)
                    Memproses...
                @else
                    Ambil Nomor
                @endif
            </button>

            @if($selected)
                <a href="{{ route('display.loket', ['id' => $selected]) }}" target="_blank" class="text-sm text-blue-600 hover:underline">Lihat Display Loket Ini</a>
            @endif
        </div>

        @if($successMessage || $ticket)
            @php
                $num = data_get($ticket, 'queue_number') ?? data_get($ticket, 'number') ?? data_get($ticket, 'no') ?? data_get($ticket, 'code');
                $note = data_get($ticket, 'subtitle') ?? data_get($ticket, 'patient_name') ?? data_get($ticket, 'name');
            @endphp
            <div class="mt-6 rounded-lg border border-emerald-300 bg-emerald-50 p-5 text-emerald-800 dark:border-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-200">
                <div class="text-sm font-medium">Berhasil</div>
                <div class="mt-1 text-2xl font-extrabold tabular-nums">{{ $num ?? '-' }}</div>
                @if($note)
                    <div class="text-sm text-emerald-700 dark:text-emerald-300">{{ $note }}</div>
                @endif
                @if($successMessage)
                    <div class="mt-2 text-sm">{{ $successMessage }}</div>
                @endif
            </div>
        @endif
    </div>
    
</div>

