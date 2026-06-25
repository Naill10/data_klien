@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Import Data Klien</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400">Upload file Excel untuk import data klien</p>
</div>

<div class="rounded-xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
    
    {{-- Download Template --}}
    <div class="mb-6">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-white/90 mb-2">Step 1 - Download Template</h3>
        <p class="text-sm text-gray-500 mb-3">Download template Excel, isi data klien sesuai format, lalu upload.</p>
        <a href="{{ route('klien.import.template') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">
            Download Template Excel
        </a>
    </div>

    <hr class="border-gray-200 dark:border-gray-800 mb-6">

    {{-- Upload File --}}
    <div>
        <h3 class="text-sm font-semibold text-gray-700 dark:text-white/90 mb-2">Step 2 - Upload File</h3>
        <p class="text-sm text-gray-500 mb-3">Upload file Excel yang sudah diisi.</p>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('klien.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center gap-3">
                <input type="file" name="file" accept=".xlsx,.xls,.csv"
                    class="text-sm text-gray-500 file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-brand-700 hover:file:bg-brand-100" />
                <button type="submit"
                    class="rounded-lg bg-brand-500 hover:bg-brand-600 px-5 py-2 text-sm font-medium text-white transition">
                    Upload & Import
                </button>
            </div>
            @error('file')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </form>
    </div>
</div>
@endsection