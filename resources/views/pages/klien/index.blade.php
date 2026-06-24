@extends('layouts.app')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Data Klien</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua data klien perusahaan</p>
    </div>
    <a href="{{ route('klien.create') }}"
        class="bg-brand-500 hover:bg-brand-600 flex items-center gap-2 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
        + Tambah Klien
    </a>
</div>

@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-400">
        {{ session('success') }}
    </div>
@endif

{{-- Search --}}
<div class="mb-4">
    <form method="GET" action="{{ route('klien.index') }}">
        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z" fill="currentColor"/>
                </svg>
            </span>
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Cari nama, perusahaan, atau email..."
                class="h-11 w-full rounded-lg border border-gray-200 bg-white pl-10 pr-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-white/90" />
        </div>
    </form>
</div>

{{-- Tabel --}}
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-white/[0.03]">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">No</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Nama Klien</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Perusahaan</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Email</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">No. Telpon</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Status</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500 dark:text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @forelse ($klien as $index => $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                        <td class="px-4 py-3 text-gray-500">{{ $klien->firstItem() + $index }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-white/90">{{ $item->nama_klien }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $item->nama_perusahaan }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $item->email ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $item->no_telpon ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if ($item->status === 'Aktif')
                                <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('klien.edit', $item->id) }}"
                                    class="rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400">
                                    Edit
                                </a>
                                <form action="{{ route('klien.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data klien ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">
                            Belum ada data klien. <a href="{{ route('klien.create') }}" class="text-brand-500 hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($klien->hasPages())
        <div class="border-t border-gray-100 px-4 py-3 dark:border-gray-800">
            {{ $klien->links() }}
        </div>
    @endif
</div>
@endsection