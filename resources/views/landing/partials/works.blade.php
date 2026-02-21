<section id="cara-kerja" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-16 reveal">
                <p class="text-blue-600 text-sm font-bold uppercase tracking-widest mb-2">Langkah Mudah</p>
                <h2 class="text-3xl font-extrabold text-slate-900">Cara Kerja Platform</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-12 relative">
                {{-- Arrow decoration (hidden on mobile) --}}
                <div class="hidden md:block absolute top-10 left-1/4 right-1/4 h-0.5 border-t-2 border-dashed border-slate-200 -z-0"></div>
                
                @foreach([
                    ['n'=>'01','i'=>'bi-pencil-square','t'=>'Kirim Aspirasi','d'=>'Masuk ke akunmu dan tuliskan aspirasimu secara jelas.'],
                    ['n'=>'02','i'=>'bi-search','t'=>'Proses Verifikasi','d'=>'Tim kesiswaan atau osis akan meninjau dan memvalidasi laporanmu.'],
                    ['n'=>'03','i'=>'bi-check-all','t'=>'Tindak Lanjut','d'=>'Aspirasi dieksekusi dan kamu mendapat update status.'],
                ] as $step)
                <div class="reveal text-center relative z-10">
                    <div class="w-20 h-20 rounded-3xl bg-blue-50 border-2 border-white shadow-sm flex items-center justify-center text-blue-600 text-3xl mx-auto mb-6">
                        <i class="bi {{ $step['i'] }}"></i>
                    </div>
                    <div class="text-blue-600 font-black text-xs uppercase mb-2 tracking-widest">Langkah {{ $step['n'] }}</div>
                    <h4 class="font-bold text-slate-900 mb-3">{{ $step['t'] }}</h4>
                    <p class="text-sm text-slate-500 leading-relaxed px-6">{{ $step['d'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
