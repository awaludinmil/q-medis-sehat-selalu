<div class="mx-auto max-w-sm mt-16">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <h1 class="text-xl font-semibold">Login</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Masuk menggunakan email dan password.</p>

        @if($error)
            <div class="mt-4 rounded-md bg-red-50 p-3 text-sm text-red-700 dark:bg-red-900/30 dark:text-red-200">{{ $error }}</div>
        @endif

        <form wire:submit.prevent="login" class="mt-4 space-y-4">
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" wire:model.defer="email" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" required />
            </div>
            <div>
                <label class="block text-sm font-medium">Password</label>
                <input type="password" wire:model.defer="password" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" required />
            </div>
            <button type="submit" class="w-full rounded-md bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700">Masuk</button>
        </form>

        <div class="mt-6">
            <a href="{{ route('auth.login.google') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                <svg width="18" height="18" viewBox="0 0 48 48" class="-ml-1"><path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24 s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,16.108,18.961,14,24,14c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657 C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.191-5.238C29.211,35.091,26.715,36,24,36 c-5.202,0-9.616-3.317-11.278-7.946l-6.511,5.02C9.5,39.556,16.227,44,24,44z"/><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24 s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
                <span>Masuk dengan Google</span>
            </a>
        </div>
    </div>
</div>
