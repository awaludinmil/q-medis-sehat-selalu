<div class="min-h-screen p-8">
    <!-- Header -->
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] shadow-xl mb-6">
                <i class="fas fa-hospital-user text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Q-Medis Kiosk</h1>
            <p class="text-lg text-gray-600">Ambil Nomor Antrian Anda</p>
        </div>

        @if($error)
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <p class="text-red-800">{{ $error }}</p>
                </div>
            </div>
        @endif

        <!-- Loket Selection -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">
                <i class="fas fa-door-open mr-2 text-blue-600"></i>Pilih Loket
            </h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($lokets as $l)
                    @php
                        $id = data_get($l, 'id') ?? data_get($l, 'loket_id') ?? null;
                        $name = data_get($l, 'nama_loket') ?? data_get($l, 'name') ?? data_get($l, 'nama') ?? data_get($l, 'label') ?? ('Loket ' . $id);
                        $desc = data_get($l, 'deskripsi') ?? data_get($l, 'description') ?? '';
                        $isActive = (string) $selected !== '' && (string) $selected === (string) $id;
                    @endphp
                    <button type="button"
                            wire:click="select({{ (int) $id }})"
                            class="group relative rounded-xl border-2 p-6 text-left transition-all focus:outline-none focus:ring-4 focus:ring-blue-500/20 {{ $isActive ? 'border-blue-600 bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg' : 'border-gray-200 bg-white hover:border-blue-300 hover:shadow-md' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Loket</div>
                                <div class="text-xl font-bold text-gray-800">{{ $name }}</div>
                                @if($desc)
                                    <div class="text-sm text-gray-600 mt-1">{{ $desc }}</div>
                                @endif
                            </div>
                            <div class="ml-3">
                                @if($isActive)
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] shadow-lg">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 group-hover:bg-blue-100 transition-colors">
                                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-blue-600"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </button>
                @empty
                    <div class="sm:col-span-2 lg:col-span-3 rounded-xl border border-gray-200 p-8 text-center text-gray-500 bg-gray-50">
                        <i class="fas fa-info-circle text-3xl mb-3 text-gray-400"></i>
                        <p>Tidak ada loket tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-4 mb-6">
            <button type="button"
                    wire:click="ambilNomor"
                    @disabled(!$selected)
                    class="px-8 py-4 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 transition-all disabled:cursor-not-allowed disabled:opacity-50 disabled:transform-none text-lg">
                @if($loading)
                    <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                @else
                    <i class="fas fa-ticket-alt mr-2"></i> Ambil Nomor Antrian
                @endif
            </button>

            @if($selected)
                <a href="{{ route('display.loket', ['id' => $selected]) }}" target="_blank" class="px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-all">
                    <i class="fas fa-external-link-alt mr-2"></i> Lihat Display Loket
                </a>
            @endif
        </div>

        <!-- Success Message -->
        @if($successMessage || $ticket)
            @php
                $num = data_get($ticket, 'queue_number') ?? data_get($ticket, 'number') ?? data_get($ticket, 'no') ?? data_get($ticket, 'code') ?? data_get($ticket, 'nomor_antrian');
                $note = data_get($ticket, 'subtitle') ?? data_get($ticket, 'patient_name') ?? data_get($ticket, 'name');
            @endphp
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl shadow-xl border-2 border-green-300 p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-500 shadow-lg mb-4">
                    <i class="fas fa-check text-2xl text-white"></i>
                </div>
                <div class="text-lg font-semibold text-green-800 mb-2">Nomor Antrian Anda</div>
                <div class="text-6xl font-extrabold text-green-700 tabular-nums mb-3">{{ $num ?? '-' }}</div>
                @if($note)
                    <div class="text-lg text-green-700 mb-2">{{ $note }}</div>
                @endif
                @if($successMessage)
                    <div class="text-sm text-green-600">{{ $successMessage }}</div>
                @endif
                <div class="mt-6 pt-6 border-t border-green-200">
                    <p class="text-sm text-green-700">Silakan tunggu nomor Anda dipanggil</p>
                </div>
            </div>
        @endif
    </div>
</div>

