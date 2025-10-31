@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl space-y-8">
    <div>
        <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Ringkasan operasional antrian.</p>
    </div>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="text-sm text-gray-500">Total Loket</div>
            <div class="mt-2 text-3xl font-extrabold tabular-nums">—</div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="text-sm text-gray-500">Antrean Aktif</div>
            <div class="mt-2 text-3xl font-extrabold tabular-nums">—</div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="text-sm text-gray-500">Sedang Dilayani</div>
            <div class="mt-2 text-3xl font-extrabold tabular-nums">—</div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="text-sm text-gray-500">Selesai Hari Ini</div>
            <div class="mt-2 text-3xl font-extrabold tabular-nums">—</div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900 lg:col-span-2">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Ringkasan Loket</h2>
                <a href="{{ route('admin.lokets') }}" class="text-sm text-blue-600 hover:underline">Kelola</a>
            </div>
            <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800/60">Tidak ada data.</div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800/60">—</div>
                <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-800/60">—</div>
            </div>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <h2 class="text-lg font-semibold">Tindakan Cepat</h2>
            <div class="mt-4 space-y-3">
                <a class="block rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700" href="{{ route('admin.antrians') }}">Buat Antrian</a>
                <a class="block rounded-md bg-emerald-600 px-4 py-2 text-white hover:bg-emerald-700" href="{{ route('admin.users') }}">Tambah Petugas</a>
                <a class="block rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700" href="{{ route('display.overview') }}">Layar Display</a>
            </div>
        </div>
    </div>
</div>
@endsection
