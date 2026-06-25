@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Detail Klien</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Informasi lengkap data klien</p>
    </div>
    <a href="{{ route('klien.index') }}"
        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700  dark:border-gray-700 dark:text-gray-400">
        ← Kembali
    </a>
</div>

<div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Nama Klien</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->nama_klien }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Nama Perusahaan</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->nama_perusahaan }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Email</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->email ?? '-' }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">No. Telpon</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->no_telpon ?? '-' }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
            <p class="mt-1">
                @if ($klien->status === 'Aktif')
                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Aktif</span>
                @else
                    <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">Tidak Aktif</span>
                @endif
            </p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Tanggal Mulai Kerja Sama</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">
                {{ $klien->tanggal_kerjasama ? \Carbon\Carbon::parse($klien->tanggal_kerjasama)->format('d M Y') : '-' }}
            </p>
        </div>

        <div class="sm:col-span-2">
            <p class="text-xs text-gray-500 dark:text-gray-400">Alamat</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->alamat ?? '-' }}</p>
        </div>

        <div class="sm:col-span-2">
            <p class="text-xs text-gray-500 dark:text-gray-400">Catatan</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->catatan ?? '-' }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat Pada</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div>
            <p class="text-xs text-gray-500 dark:text-gray-400">Terakhir Diupdate</p>
            <p class="mt-1 font-medium text-gray-800 dark:text-white/90">{{ $klien->updated_at->format('d M Y, H:i') }}</p>
        </div>

    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('klien.edit', $klien->id) }}"
            class="bg-brand-500 hover:bg-brand-600 rounded-lg px-5 py-2.5 text-sm font-medium text-white transition">
            Edit Data
        </a>
    </div>
</div>
@endsection