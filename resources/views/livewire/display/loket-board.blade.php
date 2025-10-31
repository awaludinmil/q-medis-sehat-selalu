<div class="min-h-screen p-6 text-gray-900 bg-white dark:bg-gray-900 dark:text-white">
    @if($error)
        <div class="mb-4 rounded-md bg-red-50 p-4 text-red-700 dark:bg-red-900/30 dark:text-red-200">
            {{ $error }}
        </div>
    @endif

    <div wire:poll.{{ config('api.poll_ms', 3000) }}ms="refresh" class="max-w-5xl mx-auto">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            @include('livewire.display.partials.current-ticket', [
                'ticket' => $current ?? null,
                'loket' => $loket ?? null,
            ])
            @include('livewire.display.partials.next-ticket-list', [
                'tickets' => $next ?? [],
            ])
        </div>
    </div>
</div>
