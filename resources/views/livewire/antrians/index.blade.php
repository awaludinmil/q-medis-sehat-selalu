<div class="space-y-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div class="space-y-2">
            <h1 class="text-xl font-semibold">Antrians</h1>
            <div class="flex items-center gap-2">
                <button wire:click="refresh" class="rounded-md bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700">Refresh</button>
            </div>
        </div>
        <form wire:submit.prevent="create" class="flex items-end gap-2">
            <div>
                <label class="block text-xs font-medium">Loket ID</label>
                <input type="number" wire:model.defer="loket_id" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" required />
            </div>
            <button type="submit" class="rounded-md bg-green-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-green-700">Tambah</button>
        </form>
    </div>

    <div class="rounded-lg border border-gray-200 p-4 dark:border-gray-700">
        <form wire:submit.prevent="updateStatus" class="flex flex-wrap items-end gap-2">
            <div>
                <label class="block text-xs font-medium">ID Antrian</label>
                <input type="number" wire:model.defer="update_id" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" />
            </div>
            <div>
                <label class="block text-xs font-medium">Status</label>
                <input type="text" placeholder="mis. dipanggil" wire:model.defer="status" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" />
            </div>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-indigo-700">Update Status</button>
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
                    <th class="px-3 py-2 text-left">Loket</th>
                    <th class="px-3 py-2 text-left">Nomor</th>
                    <th class="px-3 py-2 text-left">Status</th>
                    <th class="px-3 py-2 text-left">Waktu Panggil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $r)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="px-3 py-2">{{ $r['id'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['loket_id'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['nomor_antrian'] ?? $r['queue_number'] ?? $r['number'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['status'] ?? '' }}</td>
                        <td class="px-3 py-2">{{ $r['waktu_panggil'] ?? $r['called_at'] ?? '' }}</td>
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
