<section class="pt-16 pb-12 bg-gradient-to-b from-blue-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="text-center lg:text-left">
                    <div class="reveal inline-flex items-center gap-2 bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full mb-6">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                        Platform Aspirasi Resmi SMK N 5 Telkom
                    </div>

                    <h1 class="reveal d1 text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-5">
                        Suarakan Idemu<br>
                        untuk <span class="text-blue-600">Sekolah Lebih Baik</span>
                    </h1>

                    <p class="reveal d2 text-base text-slate-500 leading-relaxed max-w-md mx-auto lg:mx-0 mb-8">
                        Sampaikan saran, keluhan, atau ide kreatifmu secara langsung. Mari bangun masa depan SMK N 5 Telkom Banda Aceh bersama-sama.
                    </p>

                    <div class="reveal d3 flex flex-wrap justify-center lg:justify-start gap-3">
                        @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="btn-blue inline-flex items-center gap-2 px-7 py-3.5 rounded-xl text-white font-bold text-sm">
                                    <i class="bi bi-send-fill"></i> Urus Aspirasi Siswa
                                </a>
                            @else
                                <a href="{{ route('aspirasi.index') }}" class="btn-blue inline-flex items-center gap-2 px-7 py-3.5 rounded-xl text-white font-bold text-sm">
                                    <i class="bi bi-send-fill"></i> Mulai Lapor
                                </a>
                                <a href="#fitur" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl border border-slate-200 text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">
                                    Pelajari Fitur
                                </a>
                            @endif
                        @else
                        <a href="{{ route('login') }}" class="btn-blue inline-flex items-center gap-2 px-7 py-3.5 rounded-xl text-white font-bold text-sm">
                            <i class="bi bi-send-fill"></i> Mulai Lapor
                        </a>
                        <a href="#fitur" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl border border-slate-200 text-slate-700 font-bold text-sm hover:bg-slate-50 transition-colors">
                            Pelajari Fitur
                        </a>
                        @endauth
                        @endif
                    </div>
                </div>

                <div class="mt-12 lg:mt-0 reveal d2 flex justify-center">
                    <div class="relative float">
                        <div class="absolute inset-0 bg-blue-200 rounded-full blur-3xl opacity-30 scale-90"></div>
                        <img src="{{ asset('asset/ilustrasi.jpg') }}" alt="Ilustrasi" class="relative w-full max-w-sm drop-shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>
