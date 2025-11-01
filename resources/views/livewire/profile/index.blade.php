<div>
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Profile Saya</h1>
        <button wire:click="loadProfile" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg shadow hover:shadow-md transition-all text-sm font-semibold">
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

    @if($success)
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-800">{{ $success }}</p>
            </div>
        </div>
    @endif

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header with Avatar -->
        <div class="bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] h-32"></div>
        <div class="px-6 pb-6">
            <div class="flex flex-col md:flex-row items-center md:items-start -mt-16 mb-6">
                <div class="relative">
                    @if($avatar)
                        <img src="{{ $avatar }}" alt="Avatar" class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user text-gray-400 text-5xl"></i>
                        </div>
                    @endif
                </div>
                <div class="md:ml-6 mt-4 md:mt-16 text-center md:text-left flex-1">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user['name'] ?? 'N/A' }}</h2>
                    <p class="text-gray-600 mt-1">{{ $user['email'] ?? 'N/A' }}</p>
                    <div class="mt-2">
                        <span class="inline-block px-4 py-1.5 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-full text-sm font-semibold">
                            <i class="fas fa-user-tag mr-1"></i> {{ ucfirst($user['role'] ?? 'user') }}
                        </span>
                    </div>
                </div>
                <div class="mt-4 md:mt-16">
                    <button wire:click="openEditModal" class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-lg hover:shadow-xl transition-all text-sm font-semibold">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i> Informasi Detail
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</label>
                        <p class="text-base text-gray-800">{{ $user['name'] ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                        <p class="text-base text-gray-800">{{ $user['email'] ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Role</label>
                        <p class="text-base text-gray-800">{{ ucfirst($user['role'] ?? '-') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">User ID</label>
                        <p class="text-base text-gray-800">{{ $user['id'] ?? '-' }}</p>
                    </div>
                    @if(isset($user['google_id']) && $user['google_id'])
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Login Method</label>
                        <p class="text-base text-gray-800">
                            <i class="fab fa-google text-red-500 mr-1"></i> Google OAuth
                        </p>
                    </div>
                    @endif
                    @if(isset($user['created_at']))
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Bergabung Sejak</label>
                        <p class="text-base text-gray-800">{{ date('d M Y', strtotime($user['created_at'])) }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profile -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div wire:click="closeEditModal" class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-user-edit mr-2 text-blue-600"></i> Edit Profile
                    </h3>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form wire:submit.prevent="updateProfile">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user mr-1"></i> Nama Lengkap
                            </label>
                            <input type="text" wire:model.defer="name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-1"></i> Email
                            </label>
                            <input type="email" wire:model.defer="email" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="nama@email.com" required>
                        </div>
                        <div class="border-t border-gray-200 pt-4 mt-2">
                            <p class="text-sm font-semibold text-gray-700 mb-3">
                                <i class="fas fa-lock mr-1"></i> Ubah Password (Opsional)
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" wire:model.defer="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Minimal 6 karakter">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" wire:model.defer="password_confirmation" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[color:rgb(var(--qm-primary))] focus:border-transparent" placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-6">
                        <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-[color:rgb(var(--qm-primary))] to-[color:rgb(var(--qm-accent))] text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
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
</div>
