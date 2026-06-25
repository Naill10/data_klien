@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Tambah Klien Baru</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400">Isi data klien dengan lengkap</p>
</div>

<div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
    <form method="POST" action="{{ route('klien.store') }}">
        @csrf
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

            {{-- Nama Klien --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama Klien <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_klien" value="{{ old('nama_klien') }}"
                    placeholder="Nama lengkap klien"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 @error('nama_klien') border-red-500 @enderror" />
                @error('nama_klien')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Perusahaan --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama Perusahaan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}"
                    placeholder="PT / CV / UD ..."
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 @error('nama_perusahaan') border-red-500 @enderror" />
                @error('nama_perusahaan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    placeholder="email@perusahaan.com"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- No Telpon --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">No. Telpon</label>
                <input type="text" name="no_telpon" value="{{ old('no_telpon') }}"
                    placeholder="08xx-xxxx-xxxx"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
            </div>

            {{-- Status --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            {{-- Tanggal Kerjasama --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tanggal Mulai Kerja Sama</label>
                <input type="date" name="tanggal_kerjasama" value="{{ old('tanggal_kerjasama') }}"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
            </div>

            {{-- Alamat --}}
            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}"
                    placeholder="Jl. ..."
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
            </div>

            {{-- Catatan --}}
            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Catatan</label>
                <textarea name="catatan" rows="3" placeholder="Catatan tambahan..."
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('catatan') }}</textarea>
            </div>

            {{-- Kategori --}}
            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori') }}"
                    placeholder="Kategori klien (opsional)"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                    

        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit"
                class="bg-brand-500 hover:bg-brand-600 rounded-lg px-5 py-2.5 text-sm font-medium text-white transition">
                Simpan Data
            </button>
            <a href="{{ route('klien.index') }}"
                class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection