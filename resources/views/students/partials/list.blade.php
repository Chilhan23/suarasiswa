<div x-show="tab === 'list'" x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-3"
    class="p-4 md:p-10">

    {{-- TOAST --}}
    <div class="fixed top-4 right-4 md:top-6 md:right-6 z-[9999] flex flex-col gap-3 pointer-events-none max-w-[calc(100vw-2rem)] md:max-w-sm">
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 translate-x-8"
            class="pointer-events-auto flex items-center gap-3 bg-white border border-emerald-200 shadow-xl shadow-emerald-100/50 px-4 py-3 rounded-2xl">
            <div class="w-8 h-8 bg-emerald-500 rounded-xl flex items-center justify-center text-white shrink-0">
                <i class="bi bi-check2"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-black text-slate-800">Berhasil!</p>
                <p class="text-xs text-slate-500 font-medium truncate">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-slate-300 hover:text-slate-500 shrink-0"><i class="bi bi-x-lg text-sm"></i></button>
        </div>
        @endif
        @if(session('error') || $errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-8"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 translate-x-8"
            class="pointer-events-auto flex items-center gap-3 bg-white border border-rose-200 shadow-xl shadow-rose-100/50 px-4 py-3 rounded-2xl">
            <div class="w-8 h-8 bg-rose-500 rounded-xl flex items-center justify-center text-white shrink-0">
                <i class="bi bi-exclamation-lg"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-black text-slate-800">Gagal!</p>
                <p class="text-xs text-slate-500 font-medium truncate">{{ session('error') ?? 'Cek form kamu ya.' }}</p>
            </div>
            <button @click="show = false" class="text-slate-300 hover:text-slate-500 shrink-0"><i class="bi bi-x-lg text-sm"></i></button>
        </div>
        @endif
    </div>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 md:mb-8">
        <div>
            <h2 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight">Aspirasiku 📋</h2>
            <p class="text-slate-500 font-medium text-xs md:text-sm mt-1 hidden sm:block">Pantau status dan tanggapan dari setiap aspirasi yang kamu kirim.</p>
        </div>
        <div class="flex items-center gap-2 shrink-0">
            <div class="bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-sm">
                <span class="text-xs font-black text-slate-500">{{ sprintf('%02d', $aspirasi->count()) }} Total</span>
            </div>
            <button @click="tab = 'create'"
                class="flex items-center gap-1.5 px-3 py-2 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95">
                <i class="bi bi-plus-lg"></i> <span class="hidden sm:inline">Baru</span>
            </button>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-3 gap-2 md:gap-3 mb-5 md:mb-7">
        @foreach([
            ['label'=>'Pending', 'status'=>'pending','color'=>'amber','icon'=>'bi-clock-fill'],
            ['label'=>'Diproses','status'=>'proses',  'color'=>'sky',  'icon'=>'bi-hourglass-split'],
            ['label'=>'Selesai', 'status'=>'selesai', 'color'=>'emerald','icon'=>'bi-check2-circle'],
        ] as $stat)
        <div class="bg-white border border-slate-100 rounded-2xl p-3 md:p-4 flex items-center gap-2 md:gap-3 shadow-sm">
            <div class="w-7 h-7 md:w-8 md:h-8 bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600 rounded-lg md:rounded-xl flex items-center justify-center text-xs md:text-sm shrink-0">
                <i class="bi {{ $stat['icon'] }}"></i>
            </div>
            <div>
                <p class="text-[8px] md:text-[9px] text-slate-400 font-black uppercase tracking-wider leading-none">{{ $stat['label'] }}</p>
                <p class="text-base md:text-lg font-black text-slate-800 leading-none mt-0.5">{{ sprintf('%02d', $aspirasi->where('status',$stat['status'])->count()) }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- List --}}
    <div class="space-y-3 md:space-y-4">
        @forelse($aspirasi as $index => $list)
        @php
            $statusCfg = [
                'pending' => ['bar'=>'bg-amber-400','badge'=>'bg-amber-50 text-amber-700 border-amber-200','dot'=>'bg-amber-400','label'=>'Pending','icon'=>'bi-clock-fill','glow'=>'hover:border-amber-200 hover:shadow-amber-50'],
                'proses'  => ['bar'=>'bg-sky-500',  'badge'=>'bg-sky-50 text-sky-700 border-sky-200',     'dot'=>'bg-sky-400',  'label'=>'Diproses','icon'=>'bi-hourglass-split','glow'=>'hover:border-sky-200 hover:shadow-sky-50'],
                'selesai' => ['bar'=>'bg-emerald-500','badge'=>'bg-emerald-50 text-emerald-700 border-emerald-200','dot'=>'bg-emerald-400','label'=>'Selesai','icon'=>'bi-check2-circle','glow'=>'hover:border-emerald-200 hover:shadow-emerald-50'],
            ];
            $sc = $statusCfg[$list->status] ?? $statusCfg['pending'];
        @endphp

        <div x-data="{ openDetail: false, openEdit: false, openDelete: false }"
            class="bg-white border border-slate-100 rounded-[1.25rem] md:rounded-[1.5rem] overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 {{ $sc['glow'] }}">
            <div class="h-1 {{ $sc['bar'] }} w-full"></div>

            <div class="p-4 md:p-5">
                <div class="flex items-start gap-3 md:gap-4">

                    {{-- Index --}}
                    <div class="w-8 h-8 md:w-10 md:h-10 rounded-xl md:rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <span class="text-[10px] md:text-xs font-black text-slate-400">{{ sprintf('%02d', $index + 1) }}</span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0 cursor-pointer" @click="openDetail = !openDetail">
                        <div class="flex flex-wrap items-center gap-1.5 mb-1.5">
                            <span class="inline-flex items-center gap-1 text-[9px] md:text-[10px] font-black px-2 py-0.5 md:py-1 rounded-lg md:rounded-xl border {{ $sc['badge'] }}">
                                <i class="bi {{ $sc['icon'] }}"></i> {{ $sc['label'] }}
                            </span>
                            <span class="text-[9px] md:text-[10px] font-bold text-slate-400 bg-slate-50 px-2 py-0.5 md:py-1 rounded-lg md:rounded-xl border border-slate-100">
                                {{ $list->category->name ?? 'Umum' }}
                            </span>
                            <span class="text-[9px] md:text-[10px] text-slate-300 font-medium hidden sm:inline">
                                {{ $list->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="font-black text-slate-800 text-sm md:text-base leading-snug">{{ $list->title }}</h3>
                        <p class="text-[10px] md:text-xs text-slate-400 font-medium mt-1 line-clamp-1">
                            {{ $list->content }}
                            <span class="text-blue-400" x-show="!openDetail"> · selengkapnya</span>
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-1.5 shrink-0">
                        @if($list->status === 'pending')
                        <button @click="openEdit = true"
                            class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl border border-slate-100 hover:border-blue-200 transition-all">
                            <i class="bi bi-pencil-fill text-xs md:text-sm"></i>
                        </button>
                        <button @click="openDelete = true"
                            class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl border border-slate-100 hover:border-rose-200 transition-all">
                            <i class="bi bi-trash3-fill text-xs md:text-sm"></i>
                        </button>
                        @else
                        <div class="group/lock relative">
                            <div class="w-8 h-8 md:w-9 md:h-9 flex items-center justify-center text-slate-300 bg-slate-50 rounded-xl border border-slate-100 cursor-not-allowed">
                                <i class="bi bi-lock-fill text-xs md:text-sm"></i>
                            </div>
                            <span class="absolute bottom-full right-0 mb-2 hidden group-hover/lock:block w-max text-[9px] bg-slate-800 text-white font-bold px-2 py-1 rounded-lg shadow-lg whitespace-nowrap z-10">
                                Tidak bisa diubah
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Detail Expand --}}
                <div x-show="openDetail" x-collapse x-cloak class="mt-3 md:mt-4">
                    <div class="bg-slate-50 rounded-xl md:rounded-2xl p-3 md:p-4 border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Isi Aspirasi</p>
                        <p class="text-xs md:text-sm text-slate-600 font-medium leading-relaxed">{{ $list->content }}</p>
                    </div>
                    @if($list->admin_response)
                    <div class="mt-2 md:mt-3 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl md:rounded-2xl p-3 md:p-4 border border-emerald-100 relative overflow-hidden">
                        <i class="bi bi-chat-quote-fill absolute right-3 -bottom-2 text-[40px] text-emerald-100"></i>
                        <div class="relative">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center shrink-0">
                                    <i class="bi bi-shield-check text-[9px] text-white"></i>
                                </div>
                                <p class="text-[9px] font-black text-emerald-700 uppercase tracking-widest">Tanggapan Admin</p>
                                @if($list->processed_at)
                                <span class="text-[9px] text-emerald-400 font-medium ml-auto">{{ \Carbon\Carbon::parse($list->processed_at)->format('d M Y') }}</span>
                                @endif
                            </div>
                            <p class="text-xs md:text-sm text-emerald-800 font-medium leading-relaxed">{{ $list->admin_response }}</p>
                        </div>
                    </div>
                    @elseif($list->status !== 'pending')
                    <div class="mt-2 md:mt-3 bg-slate-50 rounded-xl p-3 border border-slate-100 border-dashed flex items-center gap-2">
                        <i class="bi bi-three-dots text-slate-300"></i>
                        <p class="text-[10px] text-slate-400 font-medium">Menunggu tanggapan dari admin...</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- MODAL EDIT --}}
            <template x-teleport="body">
                <div x-show="openEdit" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    class="fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4 bg-slate-900/60 backdrop-blur-sm">
                    <div @click.away="openEdit = false"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95"
                        class="bg-white w-full sm:max-w-lg rounded-t-[2rem] sm:rounded-[2rem] shadow-2xl overflow-hidden max-h-[95vh] overflow-y-auto">
                        <div class="flex justify-center pt-3 pb-1 sm:hidden"><div class="w-10 h-1 bg-slate-200 rounded-full"></div></div>
                        <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-6 py-4 md:px-7 md:py-5 flex items-center justify-between">
                            <div>
                                <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest mb-0.5">Edit Aspirasi</p>
                                <h3 class="text-white font-black text-sm">{{ Str::limit($list->title, 40) }}</h3>
                            </div>
                            <button @click="openEdit = false" class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center text-white/70 hover:text-white transition-all">
                                <i class="bi bi-x-lg text-sm"></i>
                            </button>
                        </div>
                        <form action="{{ route('aspirasi.update', $list->id) }}" method="POST" class="p-6 md:p-7 space-y-4 md:space-y-5">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul</label>
                                <input type="text" name="title" value="{{ $list->title }}" required
                                    class="w-full border-2 border-slate-100 bg-slate-50 rounded-xl md:rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 focus:border-blue-500 focus:bg-white outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Isi Aspirasi</label>
                                <textarea name="content" rows="4" required
                                    class="w-full border-2 border-slate-100 bg-slate-50 rounded-xl md:rounded-2xl px-4 py-3 text-sm font-medium text-slate-600 focus:border-blue-500 focus:bg-white outline-none transition-all resize-none">{{ $list->content }}</textarea>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" @click="openEdit = false"
                                    class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl md:rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">Batal</button>
                                <button type="submit"
                                    class="flex-[2] py-3 bg-blue-600 text-white rounded-xl md:rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 active:scale-95">
                                    <i class="bi bi-check-lg mr-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </template>

            {{-- MODAL HAPUS --}}
            <template x-teleport="body">
                <div x-show="openDelete" x-cloak
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    class="fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4 bg-slate-900/60 backdrop-blur-sm">
                    <div @click.away="openDelete = false"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-0 sm:scale-95"
                        class="bg-white w-full sm:max-w-sm rounded-t-[2rem] sm:rounded-[2rem] shadow-2xl overflow-hidden">
                        <div class="flex justify-center pt-3 pb-1 sm:hidden"><div class="w-10 h-1 bg-slate-200 rounded-full"></div></div>
                        <div class="p-6 md:p-7 text-center">
                            <div class="w-14 h-14 md:w-16 md:h-16 bg-rose-50 rounded-2xl md:rounded-3xl flex items-center justify-center mx-auto mb-4 border border-rose-100">
                                <i class="bi bi-trash3-fill text-xl md:text-2xl text-rose-500"></i>
                            </div>
                            <h3 class="font-black text-slate-900 text-lg md:text-xl mb-2">Hapus Aspirasi?</h3>
                            <p class="text-slate-500 text-sm leading-relaxed font-medium">
                                <span class="font-black text-slate-700">"{{ Str::limit($list->title, 30) }}"</span> akan dihapus permanen.
                            </p>
                        </div>
                        <div class="px-6 pb-6 md:px-7 md:pb-7 flex gap-3">
                            <button @click="openDelete = false"
                                class="flex-1 py-3 bg-slate-100 text-slate-500 rounded-xl md:rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all">Batal</button>
                            <form action="{{ route('aspirasi.destroy', $list->id) }}" method="POST" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full py-3 bg-rose-600 text-white rounded-xl md:rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-rose-700 transition-all shadow-lg shadow-rose-200 active:scale-95">
                                    Hapus!
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        @empty
        <div class="text-center py-16 md:py-24 bg-white border-2 border-dashed border-slate-200 rounded-[1.5rem] md:rounded-[2rem]">
            <div class="w-14 h-14 md:w-16 md:h-16 bg-slate-100 rounded-2xl md:rounded-3xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-inbox text-2xl text-slate-300"></i>
            </div>
            <p class="font-black text-slate-400 text-sm uppercase tracking-widest">Belum ada aspirasi</p>
            <p class="text-slate-300 text-xs mt-1 font-medium">Yuk kirim aspirasi pertamamu!</p>
            <button @click="tab = 'create'"
                class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                <i class="bi bi-plus-lg"></i> Kirim Sekarang
            </button>
        </div>
        @endforelse
    </div>
</div>