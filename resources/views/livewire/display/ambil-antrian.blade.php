<div class="min-h-screen p-8">
    <!-- Header -->
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] shadow-xl mb-6">
                <i class="fas fa-hospital-user text-3xl text-white"></i>
            </div>
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-[color:rgb(var(--qm-primary))] mb-2">Rumah Sakit Sehat Selalu</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] mx-auto rounded-full"></div>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Ambil Antrian</h1>
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

        <div class="display-layout grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-start">
            <!-- Loket Selection - 2 columns -->
            <div class="md:col-span-5 left-col" role="region" aria-live="polite" aria-atomic="true">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-door-open mr-2 text-blue-600"></i>Pilih Loket
                    </h2>
                    <div class="grid gap-4">
                        @forelse($lokets as $l)
                            @php
                                $id = data_get($l, 'id') ?? data_get($l, 'loket_id') ?? null;
                                $name = data_get($l, 'nama_loket') ?? data_get($l, 'name') ?? data_get($l, 'nama') ?? data_get($l, 'label') ?? ('Loket ' . $id);
                                $desc = data_get($l, 'deskripsi') ?? data_get($l, 'description') ?? '';
                                $isActive = (string) $selected !== '' && (string) $selected === (string) $id;
                            @endphp
                            <button type="button"
                                    wire:click="select({{ (int) $id }})"
                                    class="group relative rounded-xl border-2 p-5 text-left transition-all focus:outline-none focus:ring-4 focus:ring-blue-500/20 {{ $isActive ? 'border-blue-600 bg-gradient-to-br from-blue-50 to-blue-100 shadow-lg' : 'border-gray-200 bg-white hover:border-blue-300 hover:shadow-md' }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Loket</div>
                                        <div class="text-lg font-bold text-gray-800">{{ $name }}</div>
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
                            <div class="rounded-xl border border-gray-200 p-8 text-center text-gray-500 bg-gray-50">
                                <i class="fas fa-info-circle text-3xl mb-3 text-gray-400"></i>
                                <p>Tidak ada loket tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-3 mt-6">
                        <button type="button"
                                wire:click="ambilNomor"
                                @disabled(!$selected)
                                class="w-full px-6 py-4 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5 transition-all disabled:cursor-not-allowed disabled:opacity-50 disabled:transform-none text-base">
                            @if($loading)
                                <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
                            @else
                                <i class="fas fa-ticket-alt mr-2"></i> Ambil Nomor Antrian
                            @endif
                        </button>

                        @if($selected)
                            <a href="{{ route('display.loket', ['id' => $selected]) }}" target="_blank" class="w-full text-center px-6 py-4 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-blue-500 hover:text-blue-600 transition-all text-base">
                                <i class="fas fa-external-link-alt mr-2"></i> Lihat Display Loket
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Ticket Display -->
            <div class="md:col-span-7 md:flex md:justify-end right-col min-w-0 w-full">
                @php
                    $num = data_get($ticket, 'queue_number') ?? data_get($ticket, 'number') ?? data_get($ticket, 'no') ?? data_get($ticket, 'code') ?? data_get($ticket, 'nomor_antrian');
                    $note = data_get($ticket, 'subtitle') ?? data_get($ticket, 'patient_name') ?? data_get($ticket, 'name');
                @endphp

                @if($successMessage || $ticket)
                    <div class="ticket-card printable mx-auto md:ml-auto md:mr-0 bg-white rounded-2xl shadow-xl border border-gray-200 p-8 md:p-10 lg:p-12 pb-16 md:pb-16 lg:pb-16 overflow-visible text-center" style="min-height: 30rem; max-width: 560px; width: 100%;">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-500 shadow-lg mb-6">
                            <i class="fas fa-check text-3xl text-white"></i>
                        </div>
                        <div class="text-xl font-semibold text-green-800 mb-4">Nomor Antrian Anda</div>
                        <div class="font-extrabold text-green-700 tabular-nums leading-none whitespace-nowrap mb-4" style="font-size: clamp(5rem, min(30cqw, 26cqh), 18rem); letter-spacing: -0.03em;">{{ $num ?? '-' }}</div>
                        @if($note)
                            <div class="text-xl text-green-700 mt-3">{{ $note }}</div>
                        @endif
                        @if($successMessage)
                            <div class="text-base text-green-600 mt-3">{{ $successMessage }}</div>
                        @endif
                        <div class="no-print flex flex-col items-stretch justify-center space-y-3 mt-8 w-full max-w-sm mx-auto">
                            <button type="button" onclick="window.print();" title="Cetak nomor antrian" class="inline-flex w-full items-center justify-center gap-3 px-10 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-xl focus:outline-none focus:ring-4 focus:ring-emerald-500/30 transition-all text-xl">
                                <i class="fas fa-print text-xl"></i> Cetak Nomor
                            </button>
                            <button type="button" wire:click="clearAfterPrint" class="inline-flex w-full items-center justify-center gap-3 px-10 py-4 bg-white border-2 border-gray-300 text-gray-700 font-bold rounded-2xl hover:border-blue-500 hover:text-blue-600 shadow-lg transition-all text-xl">
                                <i class="fas fa-redo text-xl"></i> Ambil Lagi
                            </button>
                        </div>
                    </div>
                @else
                    <div class="w-full max-w-xl mx-auto md:ml-auto md:mr-0 rounded-2xl border border-dashed border-gray-300 bg-white p-8 md:p-10 lg:p-12 text-center text-gray-500 h-full flex items-center justify-center min-h-[28rem]">
                        <div>
                            <i class="fas fa-ticket-alt text-5xl mb-4 text-gray-400"></i>
                            <p class="text-lg">Pilih loket dan klik "Ambil Nomor Antrian".</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <style>
    @media (min-width: 768px) {
      .display-layout { display: grid; grid-template-columns: repeat(12, minmax(0,1fr)); gap: 2rem; align-items: start; }
      .display-layout .left-col { grid-column: span 5 / span 5; }
      .display-layout .right-col { grid-column: span 7 / span 7; justify-self: stretch; }
    }
    .ticket-card { container-type: size; }
    @media print {
      body * { visibility: hidden !important; }
      .printable, .printable * { visibility: visible !important; }
      .printable { position: fixed; inset: 0; background: white; }
      .no-print, .no-print * { visibility: hidden !important; display: none !important; }
    }
    </style>
    <script>
      window.addEventListener('afterprint', function(){
        try { @this.call('clearAfterPrint'); } catch (e) {}
      });
    </script>
</div>
