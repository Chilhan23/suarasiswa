<x-app-layout>
<div x-data="{ tab: '{{ session('tab', 'home') }}', mobileNav: false }" 
     class="flex h-screen w-full bg-[#F7F8FC] relative overflow-hidden">

    {{-- ======= MOBILE NAV OVERLAY ======= --}}
    <div x-show="mobileNav" x-cloak @click="mobileNav = false"
         class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 md:hidden"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-end="opacity-0">
    </div>

    {{-- ==================== SIDEBAR ==================== --}}
    <aside :class="mobileNav ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
           class="fixed md:relative md:translate-x-0 top-0 left-0 z-40 w-64 shrink-0 h-full bg-white border-r border-slate-100 flex flex-col overflow-y-auto transition-transform duration-300 ease-in-out">

        {{-- Mobile close --}}
        <button @click="mobileNav = false"
                class="md:hidden absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-700 bg-slate-100 rounded-lg">
            <i class="bi bi-x-lg text-sm"></i>
        </button>

        {{-- User Card --}}
        <div class="p-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-sm shadow-lg shadow-blue-200 shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="font-black text-slate-800 text-sm truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Siswa Aktif</p>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-4 space-y-1">
            <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.25em] px-3 mb-3">Menu</p>

            <button @click="tab = 'home'; mobileNav = false"
                :class="tab === 'home' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200/60' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700'"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold transition-all duration-200 text-sm">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-sm shrink-0"
                    :class="tab === 'home' ? 'bg-white/20' : 'bg-slate-100'">
                    <i class="bi bi-grid-fill text-xs"></i>
                </span>
                Ringkasan
            </button>

            <button @click="tab = 'list'; mobileNav = false"
                :class="tab === 'list' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200/60' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700'"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold transition-all duration-200 text-sm">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-sm shrink-0"
                    :class="tab === 'list' ? 'bg-white/20' : 'bg-slate-100'">
                    <i class="bi bi-chat-left-text-fill text-xs"></i>
                </span>
                Aspirasiku
                {{-- DI SINI SAYA BALIKIN LOGIKA LAMA BIAR GAK ERROR --}}
                @php $pending_count = $aspirasi->where('status','pending')->count(); @endphp
                @if($pending_count > 0)
                <span class="ml-auto text-[10px] font-black px-1.5 py-0.5 rounded-md"
                    :class="tab === 'list' ? 'bg-white/25 text-white' : 'bg-amber-100 text-amber-600'">
                    {{ $pending_count }}
                </span>
                @endif
            </button>

            <button @click="tab = 'create'; mobileNav = false"
                :class="tab === 'create' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200/60' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700'"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl font-bold transition-all duration-200 text-sm">
                <span class="w-7 h-7 rounded-lg flex items-center justify-center text-sm shrink-0"
                    :class="tab === 'create' ? 'bg-white/20' : 'bg-blue-50 text-blue-500'">
                    <i class="bi bi-plus-lg text-xs"></i>
                </span>
                Kirim Aspirasi
            </button>
        </nav>

        {{-- Bottom CTA --}}
        <div class="p-4">
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-4 text-white relative overflow-hidden">
                <i class="bi bi-megaphone-fill absolute -right-3 -bottom-3 text-[60px] text-white/10 rotate-12"></i>
                <p class="text-[10px] font-black uppercase tracking-widest opacity-70 mb-1">Suaramu Penting!</p>
                <p class="text-xs font-medium opacity-80 leading-relaxed">Setiap aspirasi ditinjau oleh tim kami.</p>
                <button @click="tab = 'create'; mobileNav = false"
                    class="mt-3 w-full bg-white/20 hover:bg-white/30 transition-all text-white text-[10px] font-black uppercase tracking-widest py-2 rounded-xl">
                    Kirim Sekarang
                </button>
            </div>
        </div>
    </aside>

    {{-- ==================== MAIN ==================== --}}
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
        
        {{-- Mobile top bar --}}
        <div class="md:hidden sticky top-0 z-20 bg-white/90 backdrop-blur-sm border-b border-slate-100 px-4 py-3 flex items-center justify-between shrink-0">
            <button @click="mobileNav = true" class="w-9 h-9 flex items-center justify-center bg-slate-100 rounded-xl text-slate-600">
                <i class="bi bi-list text-xl"></i>
            </button>
            <div class="flex items-center gap-2">
                <span class="text-xs font-black text-slate-700" x-text="tab === 'home' ? 'Ringkasan' : tab === 'list' ? 'Aspirasiku' : 'Kirim Aspirasi'"></span>
            </div>
            <button @click="tab = 'create'" class="w-9 h-9 flex items-center justify-center bg-blue-600 rounded-xl text-white">
                <i class="bi bi-plus-lg"></i>
            </button>
        </div>

        <main class="flex-1 overflow-y-auto p-4 md:p-10">

            {{-- ===== TAB HOME ===== --}}
            <div x-show="tab === 'home'" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-3">

                {{-- Greeting --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 md:mb-10">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full mb-3 border border-blue-100">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                            Dashboard Siswa
                        </div>
                        <h2 class="text-2xl md:text-4xl font-black text-slate-900 tracking-tight leading-none">
                            Halo, {{ explode(' ', Auth::user()->name)[0] }}! <span class="inline-block animate-bounce">👋</span>
                        </h2>
                        <p class="text-slate-500 font-medium mt-2 text-sm">Satu suara darimu sangat berarti bagi kemajuan sekolah.</p>
                    </div>
                    <button @click="tab = 'create'"
                        class="shrink-0 self-start sm:self-auto flex items-center gap-2 px-5 py-3 bg-blue-600 text-white font-bold rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 text-sm">
                        <i class="bi bi-megaphone-fill"></i>
                        Buat Aspirasi
                    </button>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-5 mb-8 md:mb-10">
                    @foreach([
                        ['label'=>'Total Aspirasi',   'icon'=>'bi-chat-square-dots-fill','bg'=>'bg-blue-100',   'text'=>'text-blue-600',   'circle'=>'bg-blue-50',   'count'=>$aspirasi->count()],
                        ['label'=>'Sedang Diproses',  'icon'=>'bi-hourglass-split',       'bg'=>'bg-amber-100',  'text'=>'text-amber-600',  'circle'=>'bg-amber-50',  'count'=>$aspirasi->where('status','proses')->count()],
                        ['label'=>'Selesai Ditangani','icon'=>'bi-check2-circle',          'bg'=>'bg-emerald-100','text'=>'text-emerald-600','circle'=>'bg-emerald-50','count'=>$aspirasi->where('status','selesai')->count()],
                    ] as $s)
                    <div class="relative bg-white rounded-2xl md:rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-6 overflow-hidden group hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                        <div class="absolute top-0 right-0 w-16 md:w-24 h-16 md:h-24 {{ $s['circle'] }} rounded-full -translate-y-6 translate-x-6 md:-translate-y-8 md:translate-x-8 group-hover:scale-110 transition-transform duration-300"></div>
                        <div class="relative">
                            <div class="w-9 h-9 md:w-12 md:h-12 {{ $s['bg'] }} {{ $s['text'] }} rounded-xl md:rounded-2xl flex items-center justify-center text-base md:text-xl mb-3 md:mb-4">
                                <i class="bi {{ $s['icon'] }}"></i>
                            </div>
                            <p class="text-[8px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 leading-tight">{{ $s['label'] }}</p>
                            <p class="text-2xl md:text-4xl font-black text-slate-900">{{ sprintf('%02d', $s['count']) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Bottom Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 md:gap-6">
                    {{-- Alur --}}
                    <div class="lg:col-span-2 bg-white rounded-2xl md:rounded-[2rem] border border-slate-100 shadow-sm p-5 md:p-7">
                        <h3 class="font-black text-slate-800 mb-5 md:mb-6 flex items-center gap-2 text-sm">
                            <span class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white shrink-0">
                                <i class="bi bi-diagram-3 text-xs"></i>
                            </span>
                            Alur Proses Aspirasi
                        </h3>
                        <div class="space-y-0">
                            @foreach([
                                ['num'=>'1','color'=>'bg-blue-600','label'=>'Kamu Kirim Aspirasi','sub'=>'Isi form dengan jelas & sopan'],
                                ['num'=>'2','color'=>'bg-amber-500','label'=>'Admin Meninjau','sub'=>'Validasi & verifikasi konten'],
                                ['num'=>'3','color'=>'bg-emerald-500','label'=>'Ditindaklanjuti','sub'=>'Proses & beri tanggapan resmi'],
                            ] as $i => $step)
                            <div class="flex gap-4 {{ $i < 2 ? 'pb-5' : '' }} relative">
                                @if($i < 2)
                                <div class="absolute left-[18px] top-9 bottom-0 w-0.5 bg-slate-100"></div>
                                @endif
                                <div class="w-9 h-9 {{ $step['color'] }} text-white rounded-full flex items-center justify-center text-xs font-black shrink-0 z-10 shadow-md">{{ $step['num'] }}</div>
                                <div class="pt-1">
                                    <p class="font-black text-slate-800 text-sm">{{ $step['label'] }}</p>
                                    <p class="text-xs text-slate-400 font-medium mt-0.5">{{ $step['sub'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Recent --}}
                    <div class="lg:col-span-3 bg-white rounded-2xl md:rounded-[2rem] border border-slate-100 shadow-sm p-5 md:p-7">
                        <div class="flex items-center justify-between mb-4 md:mb-5">
                            <h3 class="font-black text-slate-800 flex items-center gap-2 text-sm">
                                <span class="w-8 h-8 bg-slate-900 rounded-xl flex items-center justify-center text-white shrink-0">
                                    <i class="bi bi-clock-history text-xs"></i>
                                </span>
                                Terakhir Dikirim
                            </h3>
                            <button @click="tab = 'list'" class="text-[10px] text-blue-600 font-black uppercase tracking-widest hover:underline shrink-0">
                                Lihat Semua →
                            </button>
                        </div>

                        @php $recent = $aspirasi->take(3); @endphp
                        @if($recent->isEmpty())
                        <div class="text-center py-10">
                            <i class="bi bi-inbox text-4xl text-slate-200"></i>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-3">Belum ada aspirasi</p>
                        </div>
                        @else
                        <div class="space-y-2 md:space-y-3">
                            @foreach($recent as $item)
                            @php
                                $sc2 = ['pending'=>['bg-amber-50 text-amber-600 border-amber-200','bg-amber-500','Pending'],'proses'=>['bg-sky-50 text-sky-600 border-sky-200','bg-sky-500','Diproses'],'selesai'=>['bg-emerald-50 text-emerald-600 border-emerald-200','bg-emerald-500','Selesai']];
                                $s2 = $sc2[$item->status] ?? $sc2['pending'];
                            @endphp
                            <div class="flex items-center gap-3 p-3 rounded-2xl border border-slate-100 hover:border-blue-100 hover:bg-blue-50/30 transition-all cursor-pointer" @click="tab = 'list'">
                                <div class="w-2 h-2 rounded-full {{ $s2[1] }} shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-slate-700 text-sm truncate">{{ $item->title }}</p>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ $item->category->name ?? '-' }} · {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-[9px] font-black px-2 py-1 rounded-lg border {{ $s2[0] }} shrink-0">{{ $s2[2] }}</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Admin Response --}}
                @php $responded = $aspirasi->where('status','selesai')->whereNotNull('admin_response')->take(2); @endphp
                @if($responded->isNotEmpty())
                <div class="mt-4 md:mt-6 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-2xl md:rounded-[2rem] p-5 md:p-7 text-white relative overflow-hidden">
                    <i class="bi bi-chat-quote-fill absolute right-6 -bottom-4 text-[100px] text-white/10"></i>
                    <div class="relative">
                        <div class="flex items-center gap-2 mb-4 md:mb-5">
                            <i class="bi bi-shield-check text-emerald-200"></i>
                            <p class="text-[10px] font-black uppercase tracking-widest opacity-80">Tanggapan Admin Untukmu</p>
                        </div>
                        <div class="space-y-3 md:space-y-4">
                            @foreach($responded as $res)
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-4 border border-white/20">
                                <p class="text-xs font-black opacity-70 uppercase tracking-wider mb-1">{{ $res->title }}</p>
                                <p class="text-sm font-medium leading-relaxed opacity-90">{{ $res->admin_response }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- ===== TAB LIST ===== --}}
            @include('students.partials.list')

            {{-- ===== TAB CREATE ===== --}}
            @include('students.partials.create')

        </main>
    </div>
</div>
</x-app-layout>