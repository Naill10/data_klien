@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Dashboard</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400">Selamat datang, {{ auth()->user()->name }}!</p>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-6">
    <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Klien</p>
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 dark:bg-brand-900/20">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 7a4 4 0 118 0A4 4 0 018 7zM3 19a9 9 0 0118 0H3z" fill="#465FFF"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-semibold text-gray-800 dark:text-white/90">{{ $totalKlien }}</p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Klien Aktif</p>
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 dark:bg-green-900/20">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="#17B26A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-semibold text-gray-800 dark:text-white/90">{{ $klienAktif }}</p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Klien Tidak Aktif</p>
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 dark:bg-red-900/20">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" fill="#F04438"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-semibold text-gray-800 dark:text-white/90">{{ $klienTidakAktif }}</p>
    </div>
</div>

{{-- Progress Bar --}}
<div class="rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] mb-6">
    <h3 class="text-sm font-semibold text-gray-800 dark:text-white/90 mb-4">Status Keseluruhan Klien</h3>

    <div class="space-y-4">
        <div>
            <div class="flex justify-between text-sm mb-1.5">
                <span class="text-gray-600 dark:text-gray-400">Klien Aktif</span>
                <span class="font-medium text-green-600">{{ $totalKlien > 0 ? round(($klienAktif / $totalKlien) * 100) : 0 }}%</span>
            </div>
            <div class="h-2 w-full rounded-full bg-gray-100 dark:bg-gray-800">
                <div class="h-2 rounded-full bg-green-500 transition-all duration-500"
                    style="width: {{ $totalKlien > 0 ? round(($klienAktif / $totalKlien) * 100) : 0 }}%"></div>
            </div>
        </div>  

        <div>
            <div class="flex justify-between text-sm mb-1.5">
                <span class="text-gray-600 dark:text-gray-400">Klien Tidak Aktif</span>
                <span class="font-medium text-red-500">{{ $totalKlien > 0 ? round(($klienTidakAktif / $totalKlien) * 100) : 0 }}%</span>
            </div>
            <div class="h-2 w-full rounded-full bg-gray-100 dark:bg-gray-800">
                <div class="h-2 rounded-full bg-red-500 transition-all duration-500"
                    style="width: {{ $totalKlien > 0 ? round(($klienTidakAktif / $totalKlien) * 100) : 0 }}%"></div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Klien Terbaru --}}
<div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 dark:border-gray-800">
        <h3 class="text-sm font-semibold text-gray-800 dark:text-white/90">Klien Terbaru</h3>
        <a href="{{ route('klien.index') }}" class="text-sm text-brand-500      ">Lihat semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-white/[0.03]">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Nama Klien</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Perusahaan</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Status</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse ($klienTerbaru as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-white/90">{{ $item->nama_klien }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $item->nama_perusahaan }}</td>
                        <td class="px-4 py-3">
                            @if ($item->status === 'Aktif')
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">Aktif</span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada data klien.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection