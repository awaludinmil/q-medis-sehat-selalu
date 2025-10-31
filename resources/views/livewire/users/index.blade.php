<div class="space-y-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="space-y-2">
            <h1 class="text-xl font-semibold">Users</h1>
            <div class="flex items-center gap-2">
                <input type="text" placeholder="Cari..." wire:model.defer="search" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" />
                <button wire:click="refresh" class="rounded-md bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700">Refresh</button>
            </div>
        </div>
        <form wire:submit.prevent="create" class="flex items-end gap-2">
            <div>
                <label class="block text-xs font-medium">Nama</label>
                <input type="text" wire:model.defer="name" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" required />
            </div>
            <div>
                <label class="block text-xs font-medium">Email</label>
                <input type="email" wire:model.defer="email" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" required />
            </div>
            <div>
                <label class="block text-xs font-medium">Password</label>
                <input type="password" wire:model.defer="password" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" required />
            </div>
            <div>
                <label class="block text-xs font-medium">Role</label>
                <input type="text" wire:model.defer="role" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" />
            </div>
            <button type="submit" class="rounded-md bg-green-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-green-700">Tambah</button>
        </form>
    </div>

    @if($error)
        <div class="rounded-md bg-red-50 p-3 text-red-700 dark:bg-red-900/30 dark:text-red-200">{{ $error }}</div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-3 py-2 text-left">ID</th>
                    <th class="px-3 py-2 text-left">Name</th>
                    <th class="px-3 py-2 text-left">Email</th>
                    <th class="px-3 py-2 text-left">Role</th>
                    <th class="px-3 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $r)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-3 py-2">{{ $r['id'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['name'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['email'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['role'] ?? '' }}</td>
                        <td class="px-3 py-2">
                            <button wire:click="delete({{ (int) ($r['id'] ?? 0) }})" class="rounded-md bg-red-600 px-2 py-1 text-xs text-white hover:bg-red-700">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-6 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between">
        <button wire:click="prevPage" class="rounded-md border border-gray-300 px-3 py-1.5 text-sm hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">Sebelumnya</button>
        <div class="text-sm text-gray-500">Halaman {{ $page }}</div>
        <button wire:click="nextPage" class="rounded-md border border-gray-300 px-3 py-1.5 text-sm hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">Berikutnya</button>
    </div>
</div>
