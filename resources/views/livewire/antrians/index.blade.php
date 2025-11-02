<div>
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Antrian</h1>
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

    <!-- DataTable Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-bold text-blue-600"><i class="fas fa-table mr-2"></i>Daftar Antrian</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200 w-20">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200 w-24">Loket</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Nomor Antrian</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Waktu Panggil</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $r)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">{{ $r['id'] ?? '' }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800 border-b border-gray-200">
                                    <i class="fas fa-door-open mr-1 text-blue-600"></i>{{ $r['loket_id'] ?? '' }}
                                </td>
                                <td class="px-4 py-3 text-sm border-b border-gray-200">
                                    <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg text-base font-bold">
                                        {{ $r['nomor_antrian'] ?? $r['queue_number'] ?? $r['number'] ?? '' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm border-b border-gray-200">
                                    @php
                                        $status = $r['status'] ?? 'menunggu';
                                        $statusClass = match(strtolower($status)) {
                                            'dipanggil' => 'bg-yellow-500',
                                            'selesai' => 'bg-green-500',
                                            'batal' => 'bg-red-500',
                                            default => 'bg-gray-500'
                                        };
                                    @endphp
                                    <span class="inline-block px-3 py-1 {{ $statusClass }} text-white rounded-full text-xs font-semibold uppercase">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">
                                    {{ $r['waktu_panggil'] ?? $r['called_at'] ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-sm border-b border-gray-200">
                                    @if($canUpdate)
                                        <button wire:click="openEditModal({{ $r['id'] ?? 0 }})" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold transition-colors">
                                            <i class="fas fa-edit mr-1"></i> Edit Status
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-400">Tidak ada aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-gray-500 border-b border-gray-200">
                                    <i class="fas fa-folder-open text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-sm">Tidak ada data antrian.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <button wire:click="prevPage" class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors text-sm font-semibold">
                    <i class="fas fa-chevron-left mr-2"></i> Sebelumnya
                </button>
                <span class="text-sm text-gray-600">Halaman {{ $page }}</span>
                <button wire:click="nextPage" class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors text-sm font-semibold">
            </div>
        </div>
    </div>

    <!-- Modal Edit Antrian -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="closeEditModal" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Update Status Antrian</h3>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="updateStatus">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">ID Antrian</label>
                            <div class="px-4 py-3 bg-gray-100 rounded-lg text-center">
                                <span class="text-2xl font-bold text-gray-800">#{{ $update_id }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select wire:model.defer="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent">
                                <option value="menunggu">Menunggu</option>
                                <option value="dipanggil">Dipanggil</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all">
                            <i class="fas fa-save mr-2"></i> Update Status
                        </button>
                        <button type="button" wire:click="closeEditModal" class="px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
