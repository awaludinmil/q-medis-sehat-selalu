<div>
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Users / Petugas</h1>
        <div class="flex gap-3">
            <button wire:click="$set('showAddModal', true)" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg shadow-lg hover:shadow-xl transition-all text-sm font-semibold">
                <i class="fas fa-plus mr-2"></i> Tambah User
            </button>
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

    <!-- DataTable Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-bold text-blue-600"><i class="fas fa-table mr-2"></i>Daftar Users</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Email</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Role</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-gray-600 border-b border-gray-200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rows as $r)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">{{ $r['id'] ?? '' }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800 border-b border-gray-200">{{ $r['name'] ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600 border-b border-gray-200">{{ $r['email'] ?? '' }}</td>
                                <td class="px-4 py-3 text-sm border-b border-gray-200">
                                    <span class="inline-block px-3 py-1 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-full text-xs font-semibold">
                                        {{ $r['role'] ?? 'user' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm border-b border-gray-200">
                                    <div class="flex gap-2">
                                        <button wire:click="openEditModal({{ $r['id'] ?? 0 }})" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-semibold transition-colors">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </button>
                                        <button wire:click="openDeleteModal({{ $r['id'] ?? 0 }})" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-semibold transition-colors">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-12 text-center text-gray-500 border-b border-gray-200">
                                    <i class="fas fa-folder-open text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-sm">Tidak ada data.</p>
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
                    Berikutnya <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Add User -->
    @if($showAddModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="$set('showAddModal', false)" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Tambah User Baru</h3>
                    <button wire:click="$set('showAddModal', false)" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" wire:model.defer="name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" wire:model.defer="email" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="nama@email.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <input type="password" wire:model.defer="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Minimal 6 karakter" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                            <select wire:model.defer="role" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
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

    <!-- Modal Edit User -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="closeEditModal" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Edit User</h3>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" wire:model.defer="name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" wire:model.defer="email" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="nama@email.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru (Opsional)</label>
                            <input type="password" wire:model.defer="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Kosongkan jika tidak diubah">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                            <select wire:model.defer="role" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
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
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus User</h3>
                    <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.</p>
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

