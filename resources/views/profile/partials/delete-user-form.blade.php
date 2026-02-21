<style>
    /* Paksa modal biar tetep putih, gak peduli settingan browser */
    div[x-show="show"] > div:nth-child(2) {
        background-color: white !important;
    }
</style>
<section class="space-y-6">

    <header class="p-6 bg-red-50 rounded-2xl border border-red-100">
        <h2 class="text-lg font-bold text-red-600 flex items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Hapus Akun
        </h2>
        <p class="mt-1 text-sm text-red-500/80 leading-relaxed">
            Setelah akun dihapus, semua data aspirasi dan histori kamu akan hilang permanen. Tindakan ini tidak bisa dibatalkan.
        </p>
        
        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="mt-4 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-md shadow-red-100 transition-all active:scale-95">
            Hapus Akun Saya
        </button>
    </header>

    {{-- Modal Custom Style --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-slate-900">
                Kamu yakin mau pergi?
            </h2>

            <p class="mt-2 text-sm text-slate-500 leading-relaxed">
                Silakan masukkan password akun kamu untuk mengonfirmasi bahwa ini benar-benar kamu.
            </p>

            <div class="mt-6">
                <input id="password" name="password" type="password"
                    class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all"
                    placeholder="Masukkan password konfirmasi" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-600 font-medium" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" 
                    class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </button>

                <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-red-200 transition-all">
                    Ya, Hapus Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>