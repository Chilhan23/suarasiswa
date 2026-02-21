<section id="fitur" class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="text-center mb-12 reveal">
                <p class="text-blue-600 text-sm font-bold uppercase tracking-widest mb-2">Keunggulan</p>
                <h2 class="text-3xl font-extrabold text-slate-900">Kenapa SuaraSiswa?</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['i'=>'bi-lightning-charge-fill','c'=>'bg-blue-500','t'=>'Sangat Mudah','d'=>'Kirim aspirasi hanya dalam hitungan detik saja.'],
                    ['i'=>'bi-shield-lock-fill','c'=>'bg-emerald-500','t'=>'Privasi Aman','d'=>'Identitas kamu aman, admin tidak mengetahui nama pengirim Hanya NIS kamu saja.'],
                    ['i'=>'bi-graph-up-arrow','c'=>'bg-violet-500','t'=>'Real-Time','d'=>'Pantau proses tindak lanjut lewat dashboard.'],
                    ['i'=>'bi-chat-heart-fill','c'=>'bg-orange-400','t'=>'Responsif','d'=>'Tim sekolah siap menanggapi setiap saranmu.'],
                ] as $f)
                <div class="reveal bg-white p-8 rounded-3xl border border-slate-100 hover:shadow-xl hover:shadow-blue-500/5 transition-all group">
                    <div class="w-12 h-12 {{ $f['c'] }} rounded-2xl flex items-center justify-center text-white text-xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="bi {{ $f['i'] }}"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-2">{{ $f['t'] }}</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $f['d'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>