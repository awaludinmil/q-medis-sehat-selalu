<div>
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.lokets') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Loket
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Detail Loket</h1>
        </div>
        <button wire:click="refresh" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow hover:shadow-md transition-all text-sm font-semibold">
            <i class="fas fa-sync-alt mr-2"></i> Refresh
        </button>
    </div>

    @if($error)
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                <p class="text-red-800">{{ $error }}</p>
            </div>
        </div>
    @endif

    @if($loket)
        <!-- Loket Info Card -->
        <div class="bg-white rounded-xl shadow-lg mb-6 overflow-hidden">
            <div class="bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">
                            <i class="fas fa-door-open mr-2"></i>{{ $loket['nama_loket'] ?? '' }}
                        </h2>
                        <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-lg text-lg font-semibold">
                            Kode: {{ $loket['kode_prefix'] ?? '' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-sm font-semibold text-gray-600 mb-2">Deskripsi:</h3>
                <p class="text-gray-800">{{ $loket['deskripsi'] ?? 'Tidak ada deskripsi' }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-cyan-50">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-bullhorn mr-2 text-blue-600"></i>Sedang Dipanggil
                </h3>
            </div>
            <div class="p-6 flex items-center justify-between">
                @if($currentCalled)
                    <div class="flex items-center gap-3">
                        <span class="inline-block px-4 py-2 bg-gradient-to-r from-cyan-500 to-cyan-700 text-white rounded-lg text-2xl font-extrabold">
                            {{ $currentCalled['nomor_antrian'] ?? '-' }}
                        </span>
                        <span class="text-gray-600 text-sm">
                            {{ isset($currentCalled['waktu_panggil']) && $currentCalled['waktu_panggil'] ? date('d/m/Y H:i', strtotime($currentCalled['waktu_panggil'])) : '-' }}
                        </span>
                    </div>
                    @if($canUpdate)
                        <button 
                            wire:click="finishAntrian({{ $currentCalled['id'] ?? 0 }})"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow text-sm font-semibold inline-flex items-center">
                            <i class="fas fa-check mr-2"></i> Selesaikan
                        </button>
                    @endif
                @else
                    <div class="text-gray-500">Belum ada antrian yang dipanggil.</div>
                @endif
            </div>
        </div>

        <!-- Antrian Section -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-cyan-50">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-list-ol mr-2 text-blue-600"></i>Daftar Antrian
                </h3>
                <p class="text-sm text-gray-600 mt-1">Total: {{ $total }} antrian</p>
            </div>
            
            <!-- Filter & Search -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="grid grid-cols-1 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-search mr-1"></i>Cari Nomor Antrian
                        </label>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="search" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Cari nomor antrian...">
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                @if(count($antrians) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200 w-20">No</th>
                                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Nomor Antrian</th>
                                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Waktu Dibuat</th>
                                    <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Waktu Dipanggil</th>
                                    @if($canUpdate)
                                        <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200 w-56">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($antrians as $index => $a)
                                    <tr class="hover:bg-gray-50 {{ ($a['status'] ?? '') === 'dipanggil' ? 'bg-yellow-50' : '' }}">
                                        <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-sm font-bold text-gray-800 border-b border-gray-200">
                                            <span class="inline-block px-3 py-1 bg-gradient-to-r from-cyan-500 to-cyan-700 text-white rounded-lg">
                                                {{ $a['nomor_antrian'] ?? '' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm border-b border-gray-200">
                                            @php
                                                $status = $a['status'] ?? 'menunggu';
                                                $statusColors = [
                                                    'menunggu' => 'bg-yellow-100 text-yellow-800',
                                                    'dipanggil' => 'bg-blue-100 text-blue-800',
                                                    'selesai' => 'bg-green-100 text-green-800',
                                                ];
                                                $statusIcons = [
                                                    'menunggu' => 'fa-clock',
                                                    'dipanggil' => 'fa-bullhorn',
                                                    'selesai' => 'fa-check-circle',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                                <i class="fas {{ $statusIcons[$status] ?? 'fa-circle' }} mr-1"></i>
                                                {{ ucfirst($status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">
                                            {{ isset($a['created_at']) ? date('d/m/Y H:i', strtotime($a['created_at'])) : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">
                                            {{ isset($a['waktu_panggil']) && $a['waktu_panggil'] ? date('d/m/Y H:i', strtotime($a['waktu_panggil'])) : '-' }}
                                        </td>
                                        @if($canUpdate)
                                            <td class="px-4 py-3 text-sm border-b border-gray-200">
                                                <div class="flex gap-2">
                                                    @if(($a['status'] ?? '') === 'menunggu')
                                                        <button 
                                                            wire:click="callAntrian({{ $a['id'] ?? 0 }})" 
                                                            class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold transition-colors inline-flex items-center">
                                                            <i class="fas fa-bullhorn mr-1"></i> Panggil
                                                        </button>
                                                    @endif
                                                    @if(in_array($a['status'] ?? '', ['menunggu', 'dipanggil']))
                                                        <button 
                                                            wire:click="finishAntrian({{ $a['id'] ?? 0 }})" 
                                                            class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-semibold transition-colors inline-flex items-center">
                                                            <i class="fas fa-check mr-1"></i> Selesai
                                                        </button>
                                                    @endif
                                                    @if(($a['status'] ?? '') === 'selesai')
                                                        <span class="px-3 py-1.5 bg-gray-200 text-gray-500 rounded-lg text-xs font-semibold inline-flex items-center">
                                                            <i class="fas fa-check-double mr-1"></i> Selesai
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Rows per page</span>
                                <select wire:model.live="perPage" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <span class="text-sm text-gray-600">
                                {{ (($page - 1) * $perPage) + 1 }}-{{ min($page * $perPage, $total) }} of {{ $total }} rows
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <button 
                                wire:click="firstPage" 
                                @disabled($page <= 1)
                                class="px-3 py-1.5 text-sm text-blue-600 hover:bg-blue-50 rounded disabled:text-gray-400 disabled:hover:bg-transparent transition-colors">
                                <i class="fas fa-angle-double-left"></i>
                            </button>
                            <button 
                                wire:click="previousPage" 
                                @disabled($page <= 1)
                                class="px-3 py-1.5 text-sm text-blue-600 hover:bg-blue-50 rounded disabled:text-gray-400 disabled:hover:bg-transparent transition-colors">
                                Previous
                            </button>
                            <div class="flex items-center gap-2">
                                <input 
                                    type="number" 
                                    wire:model.live.debounce.500ms="page" 
                                    min="1" 
                                    max="{{ $lastPage }}" 
                                    class="w-16 px-2 py-1.5 text-center border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500">
                                <span class="text-sm text-gray-600">of {{ $lastPage }}</span>
                            </div>
                            <button 
                                wire:click="nextPage" 
                                @disabled($page >= $lastPage)
                                class="px-3 py-1.5 text-sm text-blue-600 hover:bg-blue-50 rounded disabled:text-gray-400 disabled:hover:bg-transparent transition-colors">
                                Next
                            </button>
                            <button 
                                wire:click="lastPageAction" 
                                @disabled($page >= $lastPage)
                                class="px-3 py-1.5 text-sm text-blue-600 hover:bg-blue-50 rounded disabled:text-gray-400 disabled:hover:bg-transparent transition-colors">
                                <i class="fas fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada antrian di loket ini.</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <i class="fas fa-exclamation-circle text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 text-lg">Loket tidak ditemukan.</p>
        </div>
    @endif
</div>
