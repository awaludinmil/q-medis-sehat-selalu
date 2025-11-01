{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Antrian Today Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-blue-600 uppercase mb-2">Total Hari Ini</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['statistics']['total_antrians_today'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-list-ol fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Antrian Menunggu Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-yellow-600 uppercase mb-2">Menunggu</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['statistics']['menunggu'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-clock fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Sedang Dilayani Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-cyan-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-cyan-600 uppercase mb-2">Sedang Dilayani</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['statistics']['dipanggil'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-clipboard-list fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Selesai Hari Ini Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-green-600 uppercase mb-2">Selesai Hari Ini</div>
                <div class="text-3xl font-bold text-gray-800">{{ $dashboardData['statistics']['selesai'] ?? 0 }}</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-check-circle fa-3x"></i>
            </div>
        </div>
    </div>
</div>

<!-- Current and Next Queue -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Current Queue -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-bold text-blue-600">Antrian Saat Ini</h6>
        </div>
        <div class="p-6">
            @if(!empty($dashboardData['current_queue']))
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg border-2 border-blue-200">
                    <div class="text-6xl font-bold text-blue-600 mb-2">
                        {{ $dashboardData['current_queue']['nomor_antrian'] ?? '-' }}
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ $dashboardData['current_queue']['loket']['nama_loket'] ?? '-' }}
                    </div>
                    <div class="mt-4">
                        <span class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold">
                            <i class="fas fa-phone-volume mr-2"></i>Dipanggil
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <i class="fas fa-inbox text-6xl mb-4"></i>
                    <p class="text-sm">Tidak ada antrian yang dipanggil</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Next Queue -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h6 class="text-lg font-bold text-green-600">Antrian Selanjutnya</h6>
        </div>
        <div class="p-6">
            @if(!empty($dashboardData['next_queue']))
                <div class="text-center p-8 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border-2 border-green-200">
                    <div class="text-6xl font-bold text-green-600 mb-2">
                        {{ $dashboardData['next_queue']['nomor_antrian'] ?? '-' }}
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ $dashboardData['next_queue']['loket']['nama_loket'] ?? '-' }}
                    </div>
                    <div class="mt-4">
                        <span class="px-4 py-2 bg-yellow-500 text-white rounded-full text-sm font-semibold">
                            <i class="fas fa-clock mr-2"></i>Menunggu
                        </span>
                    </div>
                </div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <i class="fas fa-inbox text-6xl mb-4"></i>
                    <p class="text-sm">Tidak ada antrian berikutnya</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Assigned Lokets and Statistics -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Loket yang Ditugaskan -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h6 class="text-lg font-bold text-blue-600">Loket yang Ditugaskan</h6>
            </div>
            <div class="p-6">
                @if(!empty($dashboardData['assigned_lokets']))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        @foreach($dashboardData['assigned_lokets'] as $loket)
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg border border-blue-200">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="text-sm font-bold text-gray-800">{{ $loket['nama_loket'] ?? '' }}</div>
                                    <span class="px-3 py-1 bg-blue-600 text-white rounded text-xs font-semibold">{{ $loket['kode_prefix'] ?? '' }}</span>
                                </div>
                                <div class="text-xs text-gray-600">
                                    {{ $loket['deskripsi'] ?? '-' }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(!empty($dashboardData['loket_statistics']))
                    <div class="space-y-3">
                        <h6 class="text-sm font-bold text-gray-700 mb-3">Statistik Per Loket</h6>
                        @foreach($dashboardData['loket_statistics'] as $stat)
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-semibold text-gray-800">{{ $stat['nama_loket'] ?? '' }}</span>
                                    <span class="text-xs font-bold text-gray-600">Total: {{ $stat['total_today'] ?? 0 }}</span>
                                </div>
                                <div class="flex gap-4 text-xs">
                                    <div class="flex items-center">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1"></span>
                                        <span class="text-gray-600">Menunggu: <strong>{{ $stat['menunggu'] ?? 0 }}</strong></span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-1"></span>
                                        <span class="text-gray-600">Dipanggil: <strong>{{ $stat['dipanggil'] ?? 0 }}</strong></span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                        <span class="text-gray-600">Selesai: <strong>{{ $stat['selesai'] ?? 0 }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h6 class="text-lg font-bold text-blue-600">Tindakan Cepat</h6>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.antrians') }}" class="block w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg font-semibold text-center shadow hover:shadow-md transition-shadow">
                    <i class="fas fa-list mr-2"></i> Kelola Antrian
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
