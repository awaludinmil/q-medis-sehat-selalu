<div class="min-h-screen p-6 text-gray-900 bg-white dark:bg-gray-900 dark:text-white">
    @if($error)
        <div class="mb-4 rounded-md bg-red-50 p-4 text-red-700 dark:bg-red-900/30 dark:text-red-200">
            {{ $error }}
        </div>
    @endif

    <div wire:poll.{{ config('api.poll_ms', 3000) }}ms="refresh" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($items as $row)
            <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                @include('livewire.display.partials.current-ticket', [
                    'ticket' => $row['current'] ?? null,
                    'loket' => $row['loket'] ?? null,
                ])
                @include('livewire.display.partials.next-ticket-list', [
                    'tickets' => $row['next'] ?? [],
                ])
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">Tidak ada data.</div>
        @endforelse
    </div>
</div>
