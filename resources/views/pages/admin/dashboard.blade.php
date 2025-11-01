@extends('layouts.admin')

@section('content')
<!-- Page Heading -->
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <a href="#" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[rgb(var(--qm-primary))] to-[rgb(var(--qm-accent))] text-white rounded-lg shadow-sm hover:shadow-md transition-shadow text-sm font-semibold">
        <i class="fas fa-download mr-2 text-sm"></i> Generate Report
    </a>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Loket Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-blue-600 uppercase mb-2">Total Loket</div>
                <div class="text-3xl font-bold text-gray-800">—</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-door-open fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Antrean Aktif Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-green-600 uppercase mb-2">Antrean Aktif</div>
                <div class="text-3xl font-bold text-gray-800">—</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-list-ol fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Sedang Dilayani Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-cyan-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-cyan-600 uppercase mb-2">Sedang Dilayani</div>
                <div class="text-3xl font-bold text-gray-800">—</div>
            </div>
            <div class="text-gray-300">
                <i class="fas fa-clipboard-list fa-3x"></i>
            </div>
        </div>
    </div>

    <!-- Selesai Hari Ini Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-xs font-bold text-yellow-600 uppercase mb-2">Selesai Hari Ini</div>
                <div class="text-3xl font-bold text-gray-800">—</div>
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="text-xs text-gray-600 uppercase font-bold mb-1">Loket 1</div>
                        <div class="text-sm text-gray-700">Tidak ada data.</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="text-xs text-gray-600 uppercase font-bold mb-1">Loket 2</div>
                        <div class="text-sm text-gray-700">—</div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <div class="text-xs text-gray-600 uppercase font-bold mb-1">Loket 3</div>
                        <div class="text-sm text-gray-700">—</div>
                    </div>
                </div>
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
@endsection
