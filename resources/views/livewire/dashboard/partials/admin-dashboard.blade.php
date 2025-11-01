{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Loket Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-blue-600 uppercase mb-2">Total Loket</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['statistics']['total_lokets'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-door-open fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Total Users Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-purple-600 uppercase mb-2">Total Users</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['statistics']['total_users'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-users fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Antrian Menunggu Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-yellow-600 uppercase mb-2">Menunggu</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['antrian_by_status']['menunggu'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-clock fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Selesai Hari Ini Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-green-600 uppercase mb-2">Selesai Hari Ini</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['antrian_by_status']['selesai'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-check-circle fa-3x"></i>
            </div>
        </div>
    </div>
</div>

<!-- Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Ringkasan Loket -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h6 class="text-lg font-bold text-blue-600">Ringkasan Loket</h6>
                <a href="{{ route('admin.lokets') }}" class="px-4 py-2 bg-gradient-to-r from-[rgb(var(--qm-primary))] to-[rgb(var(--qm-accent))] text-white rounded-lg text-sm font-semibold hover:shadow-md transition-shadow">
                    Kelola
                </a>
            </div>
            <div class="p-6">
                @if(!empty($dashboardData['loket_statistics']))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($dashboardData['loket_statistics'] as $loket)
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-sm font-bold text-gray-800">{{ $loket['nama_loket'] ?? '' }}</div>
                                    <span class="px-2 py-1 bg-blue-500 text-white rounded text-xs font-semibold">{{ $loket['kode_prefix'] ?? '' }}</span>
                                </div>
                                <div class="text-xs text-gray-600 space-y-1">
                                    <div class="flex justify-between">
                                        <span>Total Hari Ini:</span>
                                        <span class="font-semibold">{{ $loket['total_today'] ?? 0 }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Menunggu:</span>
                                        <span class="font-semibold text-yellow-600">{{ $loket['menunggu'] ?? 0 }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Selesai:</span>
                                        <span class="font-semibold text-green-600">{{ $loket['selesai'] ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">Tidak ada data loket.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Tindakan Cepat -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h6 class="text-lg font-bold text-blue-600">Tindakan Cepat</h6>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.antrians') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg font-semibold text-center shadow hover:shadow-md transition-shadow">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Antrian
                </a>
                <a href="{{ route('admin.users') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-green-500 to-green-700 text-white rounded-lg font-semibold text-center shadow hover:shadow-md transition-shadow">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Petugas
                </a>
                <a href="{{ route('display.overview') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-cyan-500 to-cyan-700 text-white rounded-lg font-semibold text-center shadow hover:shadow-md transition-shadow">
                    <i class="fas fa-tv mr-2"></i> Layar Display
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Antrians -->
@if(!empty($dashboardData['recent_antrians']))
    <div class="mt-6 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-bold text-blue-600">Antrian Terbaru</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-bold text-gray-600">Nomor</th>
                            <th class="px-4 py-2 text-left text-xs font-bold text-gray-600">Loket</th>
                            <th class="px-4 py-2 text-left text-xs font-bold text-gray-600">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-bold text-gray-600">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dashboardData['recent_antrians'] as $antrian)
                            <tr class="border-b border-gray-100">
                                <td class="px-4 py-3 text-sm font-semibold">{{ $antrian['nomor_antrian'] ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $antrian['loket']['nama_loket'] ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if(($antrian['status'] ?? '') === 'menunggu')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">Menunggu</span>
                                    @elseif(($antrian['status'] ?? '') === 'dipanggil')
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">Dipanggil</span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ isset($antrian['created_at']) ? \Carbon\Carbon::parse($antrian['created_at'])->format('H:i') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
