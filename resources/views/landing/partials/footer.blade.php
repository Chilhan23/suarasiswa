<footer class="relative bg-slate-950 pt-20 pb-10 overflow-hidden">
    {{-- Dekorasi Garis Atas --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
            
            {{-- Kolom 1: Branding --}}
            <div class="md:col-span-5">
                <a href="/" class="flex items-center gap-2 mb-6">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-900/20">
                        <i class="bi bi-megaphone-fill text-white text-base"></i>
                    </div>
                    <span class="font-bold text-2xl text-white tracking-tight">Suara<span class="text-blue-500">Siswa</span></span>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed mb-8 max-w-sm">
                    Platform aspirasi digital resmi SMK Negeri 5 Telkom Banda Aceh. Kami percaya setiap suara berhak didengar untuk menciptakan lingkungan sekolah yang lebih progresif.
                </p>
                <div class="flex gap-3">
                    <a href="https://www.instagram.com/smkn5telkomaceh/" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-blue-500 hover:bg-blue-600/10 transition-all group">
                        <i class="bi bi-instagram group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="https://www.facebook.com/smkn.5.telkom.banda.aceh/?locale=id_ID" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-blue-500 hover:bg-blue-600/10 transition-all group">
                        <i class="bi bi-facebook group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="https://www.youtube.com/@humassmkn5telkombandaaceh968" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-blue-500 hover:bg-blue-600/10 transition-all group">
                        <i class="bi bi-youtube group-hover:scale-110 transition-transform"></i>
                    </a>
                    <a href="https://www.tiktok.com/@smkn5telkomaceh" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-white hover:border-blue-500 hover:bg-blue-600/10 transition-all group">
                        <i class="bi bi-tiktok group-hover:scale-110 transition-transform"></i>
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Navigasi --}}
            <div class="md:col-span-3">
                <h4 class="text-white font-bold mb-6 flex items-center gap-2 text-sm uppercase tracking-widest">
                    <span class="w-1 h-4 bg-blue-500 rounded-full"></span>
                    Navigasi
                </h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-slate-400 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group"><i class="bi bi-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i> Beranda</a></li>
                    <li><a href="#aspirasi" class="text-slate-400 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group"><i class="bi bi-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i> Aspirasi Terbaru</a></li>
                    <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-blue-400 text-sm transition-colors flex items-center gap-2 group"><i class="bi bi-chevron-right text-[10px] group-hover:translate-x-1 transition-transform"></i> Masuk Siswa</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Kontak --}}
            <div class="md:col-span-4">
                <h4 class="text-white font-bold mb-6 flex items-center gap-2 text-sm uppercase tracking-widest">
                    <span class="w-1 h-4 bg-blue-500 rounded-full"></span>
                    Hubungi Kami
                </h4>
                <div class="space-y-4">
                    <div class="flex gap-4 p-4 rounded-2xl bg-slate-900/40 border border-slate-800/50">
                        <i class="bi bi-geo-alt-fill text-blue-500"></i>
                        <p class="text-slate-400 text-xs leading-relaxed">Jl. Stadion H. Dimurthala No. 05 Lampineung, Banda Aceh</p>
                    </div>
                    <div class="flex gap-4 p-4 rounded-2xl bg-slate-900/40 border border-slate-800/50">
                        <i class="bi bi-envelope-at-fill text-emerald-500"></i>
                        <p class="text-slate-400 text-xs">smkn5telkombandaaceh@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- AREA BAWAH: LOGO RAKSASA --}}
        <div class="pt-10 border-t border-slate-900 flex flex-col md:flex-row items-center md:items-end justify-between gap-10">
            
            {{-- Kiri: Info & Logo Berwarna --}}
            <div class="flex flex-col gap-6 order-2 md:order-1 items-center md:items-start">
                <div class="flex items-center gap-8">
                    {{-- Logo OSIS Berwarna --}}
                    <img src="{{ asset('asset/logo_osis.png') }}" alt="OSIS" class="h-14 w-auto object-contain filter drop-shadow-sm">
                    {{-- Pembatas --}}
                    <div class="w-px h-8 bg-slate-800"></div>
                    {{-- Logo Sekolah Berwarna --}}
                    <img src="{{ asset('asset/logo_sekolah.png') }}" alt="SMK 5" class="h-14 w-auto object-contain filter drop-shadow-sm">
                </div>
                <div class="text-center md:text-left">
                    <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] mb-2">Official Student Platform</p>
                    <p class="text-slate-400 text-sm font-medium">
                        &copy; {{ date('Y') }} <span class="text-white font-bold">SMK Negeri 5 Telkom Banda Aceh</span>
                    </p>
                </div>
            </div>

            {{-- SMK BISA GEDE BANGET & BERWARNA --}}
            <div class="order-1 md:order-2">
                <img src="{{ asset('asset/logo_smk_bisa.png') }}" 
                     alt="SMK Bisa SMK Hebat" 
                     class="h-32 md:h-40 w-auto object-contain brightness-110 contrast-110 transform hover:scale-105 transition-all duration-500">
            </div>

        </div>
    </div>
</footer>