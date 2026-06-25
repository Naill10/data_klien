<div>
    <div class="mb-6 rounded-2xl border border-gray-200 p-5 lg:p-6 dark:border-gray-800">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
            <div class="flex w-full flex-col items-center gap-6 xl:flex-row">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-brand-500 text-2xl font-bold text-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h4 class="mb-2 text-center text-lg font-semibold text-gray-800 xl:text-left dark:text-white/90">
                        {{ auth()->user()->name }}
                    </h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>