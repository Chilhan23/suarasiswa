<section id="aspirasi" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        {{-- Header Area --}}
        <div class="mb-12 reveal">
            {{-- Label --}}
            <div class="flex items-center gap-3 mb-4">
                <div class="h-px flex-1 max-w-[40px] bg-blue-200"></div>
                <span class="text-blue-600 text-xs font-black uppercase tracking-[0.25em]">Update Terkini</span>
            </div>

            {{-- Title + Deskripsi --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h2 class="text-4xl font-black text-slate-900 leading-tight">Aspirasi <span class="text-blue-600">Terbaru</span></h2>
                    <p class="text-slate-500 font-medium mt-2 text-sm max-w-md leading-relaxed">
                        Suara nyata dari para siswa SMK N 5 Telkom Banda Aceh — setiap aspirasi ditinjau dan ditindaklanjuti oleh tim kami.
                    </p>
                </div>

                {{-- Mini Stats --}}
                <div class="flex items-center gap-3 shrink-0">
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl px-4 py-3 text-center min-w-[80px]">
                        <p class="text-2xl font-black text-blue-600 leading-none">{{ \App\Models\Aspiration::count() }}</p>
                        <p class="text-[9px] font-black text-blue-400 uppercase tracking-widest mt-0.5">Total</p>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl px-4 py-3 text-center min-w-[80px]">
                        <p class="text-2xl font-black text-emerald-600 leading-none">{{ \App\Models\Aspiration::where('status','selesai')->count() }}</p>
                        <p class="text-[9px] font-black text-emerald-400 uppercase tracking-widest mt-0.5">Selesai</p>
                    </div>
                    <div class="bg-amber-50 border border-amber-100 rounded-2xl px-4 py-3 text-center min-w-[80px]">
                        <p class="text-2xl font-black text-amber-600 leading-none">{{ \App\Models\Aspiration::where('status','proses')->count() }}</p>
                        <p class="text-[9px] font-black text-amber-400 uppercase tracking-widest mt-0.5">Diproses</p>
                    </div>
                </div>
            </div>
        </div>

        @if($aspirasi->isEmpty())
        <div class="text-center py-16 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
            <i class="bi bi-inbox text-4xl text-slate-300"></i>
            <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mt-3">Belum ada aspirasi masuk</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($aspirasi as $i => $asp)
            @php
                // 5 warna: biru, hijau, kuning, merah, orange
                $palettes = [
                    0 => ['bar'=>'bg-blue-500',   'light'=>'bg-blue-50',   'border'=>'border-blue-100',   'hover'=>'hover:border-blue-300',   'catBg'=>'bg-blue-100',   'catText'=>'text-blue-700',   'avatar'=>'bg-blue-500'],
                    1 => ['bar'=>'bg-emerald-500', 'light'=>'bg-emerald-50','border'=>'border-emerald-100','hover'=>'hover:border-emerald-300','catBg'=>'bg-emerald-100','catText'=>'text-emerald-700','avatar'=>'bg-emerald-500'],
                    2 => ['bar'=>'bg-amber-400',   'light'=>'bg-amber-50',  'border'=>'border-amber-100',  'hover'=>'hover:border-amber-300',  'catBg'=>'bg-amber-100',  'catText'=>'text-amber-700',  'avatar'=>'bg-amber-400'],
                    3 => ['bar'=>'bg-rose-500',    'light'=>'bg-rose-50',   'border'=>'border-rose-100',   'hover'=>'hover:border-rose-300',   'catBg'=>'bg-rose-100',   'catText'=>'text-rose-700',   'avatar'=>'bg-rose-500'],
                    4 => ['bar'=>'bg-orange-500',  'light'=>'bg-orange-50', 'border'=>'border-orange-100', 'hover'=>'hover:border-orange-300', 'catBg'=>'bg-orange-100', 'catText'=>'text-orange-700', 'avatar'=>'bg-orange-500'],
                ];
                $p = $palettes[$i % 5];

                $statusCfg = [
                    'pending' => ['label'=>'Menunggu', 'dot'=>'bg-slate-400',   'text'=>'text-slate-500',   'pulse'=>false],
                    'proses'  => ['label'=>'Ditinjau', 'dot'=>'bg-blue-500',    'text'=>'text-blue-600',    'pulse'=>true],
                    'selesai' => ['label'=>'Selesai',  'dot'=>'bg-emerald-500', 'text'=>'text-emerald-600', 'pulse'=>false],
                ];
                $sc = $statusCfg[$asp->status] ?? $statusCfg['pending'];
            @endphp

            <div class="reveal {{ $p['light'] }} border {{ $p['border'] }} {{ $p['hover'] }} rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col group">

                {{-- Accent bar --}}
                <div class="h-1.5 {{ $p['bar'] }}"></div>

                <div class="p-6 flex flex-col flex-1">

                    {{-- Top Row --}}
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[10px] font-black uppercase px-3 py-1 rounded-xl {{ $p['catBg'] }} {{ $p['catText'] }} tracking-wider">
                            {{ $asp->category->name ?? 'Umum' }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                            <i class="bi bi-clock"></i> {{ $asp->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Konten --}}
                    <h4 class="font-black text-slate-900 mb-2 leading-snug">{{ $asp->title }}</h4>
                    <p class="text-sm text-slate-500 line-clamp-2 leading-relaxed flex-1">{{ $asp->content }}</p>

                    {{-- Footer --}}
                    <div class="mt-5 pt-4 border-t border-black/5 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 {{ $p['avatar'] }} rounded-full flex items-center justify-center shadow-sm">
                                <i class="bi bi-person-fill text-[9px] text-white"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-400">Siswa Anonim</span>
                        </div>
                        <div class="flex items-center gap-1.5 font-bold text-[10px] uppercase {{ $sc['text'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }} {{ $sc['pulse'] ? 'animate-pulse' : '' }}"></span>
                            {{ $sc['label'] }}
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        @if(\App\Models\Aspiration::count() > 6)
        <div class="text-center mt-10 reveal">
            <p class="text-slate-400 text-sm font-medium">
                Masih ada <span class="font-black text-slate-600">{{ \App\Models\Aspiration::count() - 6 }}+</span> aspirasi lainnya yang sedang diproses.
            </p>
        </div>
        @endif
        @endif

    </div>
</section>