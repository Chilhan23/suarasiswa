<div x-show="tab === 'create'" x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-3"
    class="p-6 md:p-10">

    <div class="max-w-2xl">

        {{-- Header --}}
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full mb-3 border border-blue-100">
                <i class="bi bi-megaphone-fill"></i> Kirim Aspirasi
            </div>
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Buat Aspirasi Baru</h2>
            <p class="text-slate-500 font-medium text-sm mt-1">Sampaikan pendapatmu dengan jelas dan sopan ya.</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">

            {{-- Top Accent --}}
            <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>

            <form action="{{ route('aspirasi.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                {{-- Row: Kategori + Topik --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Kategori --}}
                    <div>
                        <label for="category_id" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">
                            Kategori <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <select name="category_id" id="category_id" required
                                class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-bold text-slate-700 appearance-none cursor-pointer text-sm">
                                <option value="" disabled selected>Pilih kategori...</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                <i class="bi bi-chevron-down text-sm"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Topik --}}
                    <div>
                        <label for="title" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">
                            Judul / Topik <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" name="title" id="title" required maxlength="200"
                            placeholder="Judul singkat & jelas..."
                            class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-medium text-slate-700 placeholder-slate-300 text-sm">
                    </div>
                </div>

                {{-- Detail --}}
                <div>
                    <label for="content" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">
                        Detail Aspirasi <span class="text-rose-400">*</span>
                    </label>
                    <textarea name="content" id="content" rows="6" required
                        placeholder="Jelaskan aspirasi, saran, atau masalah yang ingin kamu sampaikan secara lengkap..."
                        class="w-full px-4 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-medium text-slate-700 placeholder-slate-300 text-sm leading-relaxed resize-none"></textarea>
                    <p class="text-[10px] text-slate-300 font-medium mt-2">
                        <i class="bi bi-info-circle mr-1"></i> Semakin detail, semakin mudah admin menindaklanjuti aspirasi kamu.
                    </p>
                </div>

                {{-- Tips Box --}}
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 flex gap-3">
                    <div class="w-7 h-7 bg-blue-600 rounded-xl flex items-center justify-center text-white shrink-0">
                        <i class="bi bi-lightbulb-fill text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-blue-700 uppercase tracking-wider mb-1">Tips Aspirasi yang Baik</p>
                        <p class="text-xs text-blue-600/80 font-medium leading-relaxed">
                            Gunakan bahasa sopan, sertakan konteks yang jelas, dan jika bisa berikan saran solusinya juga.
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-1">
                    <button type="submit"
                        class="flex-1 py-4 bg-blue-600 text-white font-black rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all active:scale-95 text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                        <i class="bi bi-send-fill"></i>
                        Kirim Aspirasi
                    </button>
                    <button type="button" @click="tab = 'home'"
                        class="px-7 py-4 bg-slate-100 text-slate-500 font-bold rounded-2xl hover:bg-slate-200 transition-all text-xs uppercase tracking-widest">
                        Batal
                    </button>
                </div>

            </form>
        </div>

        {{-- Note bawah --}}
        <div class="mt-5 flex items-start gap-2.5 bg-amber-50 border border-amber-100 rounded-2xl px-4 py-3.5">
            <i class="bi bi-shield-check text-amber-500 mt-0.5 shrink-0"></i>
            <p class="text-xs text-amber-700 font-medium leading-relaxed">
                <span class="font-black">Privasi terjaga.</span> Aspirasi kamu hanya bisa dilihat oleh admin. Sampaikan dengan jujur tanpa rasa khawatir.
            </p>
        </div>

    </div>
</div>