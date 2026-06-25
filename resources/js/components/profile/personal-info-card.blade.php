<div x-data="{saveProfile(){
    console.log('Saving profile...');
}}">
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
            <div>
                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
                    Personal Information
                </h4>

                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
                    <div>
                        <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nama</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ auth()->user()->name }}</p>
                    </div>

                    <div>
                        <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Email address</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Form Edit Langsung --}}
            <div class="w-full lg:w-auto">
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    @if(session('status') === 'profile-updated')
                        <div class="text-sm text-green-500">Profil berhasil diupdate!</div>
                    @endif

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

                    <button type="submit"
                        class="rounded-lg bg-brand-500 hover:bg-brand-600 px-5 py-2.5 text-sm font-medium text-white transition">
                        Simpan Perubahan
                    </button>
                </form>

                {{-- Form Ganti Password --}}
                <form method="POST" action="{{ route('password.update') }}" class="space-y-4 mt-6">
                    @csrf
                    @method('PUT')

                    @if(session('status') === 'password-updated')
                        <div class="text-sm text-green-500">Password berhasil diupdate!</div>
                    @endif

                    <h4 class="text-sm font-semibold text-gray-800 dark:text-white/90">Ganti Password</h4>

                    <div>
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
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 focus:border-brand-300 focus:outline-none dark:border-gray-700