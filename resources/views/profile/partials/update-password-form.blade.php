<section>
    <header class="mb-6">
        <h2 class="text-xl font-extrabold text-slate-900 flex items-center gap-2">
            <i class="bi bi-shield-lock text-blue-600"></i>
            Keamanan Akun
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Pastikan akunmu menggunakan password yang kuat untuk menjaga privasi aspirasimu.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Password Saat Ini</label>
            <input name="current_password" type="password" 
                class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all" 
                autocomplete="current-password" placeholder="••••••••">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-600 font-medium" />
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
            <input name="password" type="password" 
                class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all" 
                autocomplete="new-password" placeholder="Minimal 8 karakter">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-600 font-medium" />
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password Baru</label>
            <input name="password_confirmation" type="password" 
                class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-all" 
                autocomplete="new-password" placeholder="Ulangi password baru">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-600 font-medium" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95 flex items-center gap-2">
                <i class="bi bi-check-circle"></i>
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-bold flex items-center gap-1">
                    <i class="bi bi-check-all text-lg"></i> Berhasil disimpan
                </p>
            @endif
        </div>
    </form>
</section>