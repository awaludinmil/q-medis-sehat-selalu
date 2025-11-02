<div>
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $isAdmin ? 'Manajemen' : 'Daftar' }} Loket</h1>
        <div class="flex gap-3">
            @if($isAdmin)
                <button wire:click="$set('showAddModal', true)" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg shadow-lg hover:shadow-xl transition-all text-sm font-semibold">
                    <i class="fas fa-plus mr-2"></i> Tambah Loket
                </button>
            @endif
            <button wire:click="refresh" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow hover:shadow-md transition-all text-sm font-semibold">
                <i class="fas fa-sync-alt mr-2"></i> Refresh
            </button>
        </div>
    </div>

    @if($error)
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                <p class="text-red-800">{{ $error }}</p>
            </div>
        </div>
    @endif

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rows as $r)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-white mb-1">
                                <i class="fas fa-door-open mr-2"></i>{{ $r['nama_loket'] ?? '' }}
                            </h3>
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-lg text-sm font-semibold">
                                {{ $r['kode_prefix'] ?? '' }}
                            </span>
                        </div>
                        @if($isAdmin)
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="p-2 hover:bg-white/20 rounded-lg transition-colors text-white">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-10 py-1" style="display: none;">
                                    <a href="{{ route('admin.lokets.show', $r['id'] ?? 0) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-eye mr-2 text-blue-500"></i> View Detail
                                    </a>
                                    <button wire:click="openEditModal({{ $r['id'] ?? 0 }})" @click="open = false" class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-edit mr-2 text-green-500"></i> Update
                                    </button>
                                    <button wire:click="openDeleteModal({{ $r['id'] ?? 0 }})" @click="open = false" class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-trash mr-2 text-red-500"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('admin.lokets.show', $r['id'] ?? 0) }}" class="p-2 hover:bg-white/20 rounded-lg transition-colors text-white">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="p-4">
                    <p class="text-gray-600 text-sm mb-3">
                        {{ $r['deskripsi'] ?? 'Tidak ada deskripsi' }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span><i class="fas fa-hashtag mr-1"></i>ID: {{ $r['id'] ?? '' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg">Tidak ada data loket.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-8 bg-white px-6 py-4 rounded-lg shadow">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-600">Rows per page</span>
                <select wire:model.live="per_page" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="6">6</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
            <span class="text-sm text-gray-600">
                {{ (($page - 1) * $per_page) + 1 }}-{{ min($page * $per_page, $total) }} of {{ $total }} rows
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
                wire:click="prevPage" 
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

    <!-- Modal Add Loket -->
    @if($showAddModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="$set('showAddModal', false)" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Tambah Loket Baru</h3>
                    <button wire:click="$set('showAddModal', false)" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Loket</label>
                            <input type="text" wire:model.defer="nama_loket" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Contoh: Loket Pendaftaran" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Prefix</label>
                            <input type="text" wire:model.defer="kode_prefix" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Contoh: A" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea wire:model.defer="deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Deskripsi loket..."></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                        <button type="button" wire:click="$set('showAddModal', false)" class="px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Edit Loket -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="closeEditModal" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Edit Loket</h3>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Loket</label>
                            <input type="text" wire:model.defer="nama_loket" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Contoh: Loket Pendaftaran" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Prefix</label>
                            <input type="text" wire:model.defer="kode_prefix" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Contoh: A" required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea wire:model.defer="deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Deskripsi loket..."></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all">
                            <i class="fas fa-save mr-2"></i> Update
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

    <!-- Modal Delete Confirmation -->
    @if($showDeleteModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="closeDeleteModal" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Loket</h3>
                    <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus loket ini? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex gap-3">
                        <button wire:click="delete" class="flex-1 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors">
                            <i class="fas fa-trash mr-2"></i> Ya, Hapus
                        </button>
                        <button wire:click="closeDeleteModal" class="flex-1 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-colors">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

