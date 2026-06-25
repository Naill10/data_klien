<div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
    <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-6">Personal Information</h4>

    @if(session('status') === 'profile-updated')
        <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
            ✅ Profil berhasil diupdate!
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
            ✅ Password berhasil diupdate!
        </div>
    @endif

    {{-- Form Update Nama & Email --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4 mb-8">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit"
            class="rounded-lg bg-brand-500 hover:bg-brand-600 px-5 py-2.5 text-sm font-medium text-white transition">
            Simpan Perubahan
        </button>
    </form>

    <hr class="border-gray-200 dark:border-gray-800 mb-6">

    {{-- Form Ganti Password --}}
    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Ganti Password</h4>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Password Lama</label>
                <input type="password" name="current_password"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                @error('current_password', 'updatePassword') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Password Baru</label>
                <input type="password" name="password"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
                @error('password', 'updatePassword') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white/90" />
            </div>
        </div>

        <button type="submit"
            class="rounded-lg bg-red-500 hover:bg-red-600 px-5 py-2.5 text-sm font-medium text-white transition">
            Ganti Password
        </button>
    </form>
</div>