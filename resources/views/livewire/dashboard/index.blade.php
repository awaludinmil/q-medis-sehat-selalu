<div>
    <!-- Page Heading -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
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

    @if($loading)
        <div class="flex items-center justify-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>
    @elseif($dashboardData)
        @if($isAdmin)
            {{-- Admin Dashboard --}}
            @include('livewire.dashboard.partials.admin-dashboard')
        @else
            {{-- Petugas Dashboard --}}
            @include('livewire.dashboard.partials.petugas-dashboard')
        @endif
    @endif
</div>
