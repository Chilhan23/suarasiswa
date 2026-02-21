<x-app-layout>
    <div x-data="{ 
            tab: 'semua',
            modalOpen: false,
            sidebarOpen: false,
            selectedId: null,
            selectedTitle: '',
            selectedStatus: 'pending',
            selectedResponse: '',
            activeCategory: '{{ request('category', '') }}',
            openModal(id, title, status, response) {
                this.selectedId = id;
                this.selectedTitle = title;
                this.selectedStatus = status;
                this.selectedResponse = response ?? '';
                this.modalOpen = true;
            },
            filterCategory(slug) {
                this.activeCategory = slug;
                const url = new URL(window.location.href);
                if (slug) { url.searchParams.set('category', slug); } 
                else { url.searchParams.delete('category'); }
                window.location.href = url.toString();
            }
        }" 
        class="flex h-screen w-full bg-slate-50 relative overflow-hidden">

        {{-- ======= MOBILE OVERLAY ======= --}}
        <div x-show="sidebarOpen" x-cloak
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 md:hidden"
             x-transition:opacity>
        </div>

        {{-- ======================== SIDEBAR ======================== --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
               class="fixed md:relative top-0 left-0 z-50 w-72 h-full bg-white border-r border-slate-200 flex flex-col p-6 gap-2 transition-transform duration-300 ease-in-out shrink-0 overflow-y-auto no-scrollbar">

            <button @click="sidebarOpen = false"
                    class="md:hidden absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-700 bg-slate-100 rounded-lg">
                <i class="bi bi-x-lg text-sm"></i>
            </button>

            <div class="px-4 mb-4">
                <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-700 text-[10px] font-black uppercase tracking-[0.2em] px-3 py-1.5 rounded-full border border-blue-100">
                    <i class="bi bi-shield-fill-check"></i> Admin Panel
                </span>
            </div>

            <nav class="space-y-1">
                <button @click="tab = 'semua'; sidebarOpen = false"
                    :class="tab === 'semua' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-slate-500 hover:bg-slate-50'"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition-all text-sm">
                    <i class="bi bi-grid-1x2-fill"></i><span>Semua Aspirasi</span>
                    <span class="ml-auto text-[10px] font-black px-2 py-0.5 rounded-full"
                        :class="tab === 'semua' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'">
                        {{ $aspirasi->count() }}
                    </span>
                </button>
                <button @click="tab = 'pending'; sidebarOpen = false"
                    :class="tab === 'pending' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-slate-500 hover:bg-slate-50'"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition-all text-sm">
                    <i class="bi bi-clock-fill"></i><span>Pending</span>
                    <span class="ml-auto text-[10px] font-black px-2 py-0.5 rounded-full"
                        :class="tab === 'pending' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-600'">
                        {{ $aspirasi->where('status','pending')->count() }}
                    </span>
                </button>
                <button @click="tab = 'proses'; sidebarOpen = false"
                    :class="tab === 'proses' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-slate-500 hover:bg-slate-50'"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition-all text-sm">
                    <i class="bi bi-hourglass-split"></i><span>Diproses</span>
                    <span class="ml-auto text-[10px] font-black px-2 py-0.5 rounded-full"
                        :class="tab === 'proses' ? 'bg-white/20 text-white' : 'bg-blue-100 text-blue-600'">
                        {{ $aspirasi->where('status','proses')->count() }}
                    </span>
                </button>
                <button @click="tab = 'selesai'; sidebarOpen = false"
                    :class="tab === 'selesai' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-slate-500 hover:bg-slate-50'"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition-all text-sm">
                    <i class="bi bi-check2-circle"></i><span>Selesai</span>
                    <span class="ml-auto text-[10px] font-black px-2 py-0.5 rounded-full"
                        :class="tab === 'selesai' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-600'">
                        {{ $aspirasi->where('status','selesai')->count() }}
                    </span>
                </button>
            </nav>

            {{-- Filter Kategori --}}
            <div class="mt-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-3">Filter Kategori</p>
                @php
                    $categoryIcons = [
                        'fasilitas'=>'bi-building','akademik'=>'bi-book-fill',
                        'kebersihan'=>'bi-stars','ekstrakurikuler'=>'bi-trophy-fill',
                        'teknologi'=>'bi-cpu-fill','lainnya'=>'bi-three-dots',
                    ];
                @endphp
                <div class="space-y-1">
                    <button @click="filterCategory('')"
                        :class="activeCategory === '' ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-50'"
                        class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all text-sm">
                        <i class="bi bi-funnel-fill"></i><span>Semua Kategori</span>
                    </button>
                    @foreach($categories as $cat)
                    @php $countCat = $aspirasi->filter(fn($a) => optional($a->category)->slug === $cat->slug)->count(); @endphp
                    <button @click="filterCategory('{{ $cat->slug }}')"
                        :class="activeCategory === '{{ $cat->slug }}' ? 'bg-slate-900 text-white' : 'text-slate-500 hover:bg-slate-50'"
                        class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all text-sm">
                        <i class="bi {{ $categoryIcons[$cat->slug] ?? 'bi-tag-fill' }}"></i>
                        <span class="truncate">{{ $cat->name }}</span>
                        @if($countCat > 0)
                        <span class="ml-auto text-[10px] font-black px-2 py-0.5 rounded-full bg-slate-100 text-slate-500"
                            :class="activeCategory === '{{ $cat->slug }}' ? '!bg-white/20 !text-white' : ''">
                            {{ $countCat }}
                        </span>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>

            <div class="mt-auto pt-4 shrink-0">
                <div class="bg-gradient-to-tr from-blue-600 to-indigo-700 rounded-2xl p-5 text-white relative overflow-hidden">
                    <i class="bi bi-bar-chart-fill absolute -bottom-4 -right-4 text-[80px] text-white/10"></i>
                    <p class="text-[10px] font-black uppercase tracking-wider opacity-70 mb-1">Masuk Hari Ini</p>
                    <p class="text-3xl font-black leading-none">{{ $aspirasi->filter(fn($a) => $a->created_at->isToday())->count() }}</p>
                    <p class="text-xs opacity-70 mt-1 font-medium">baru</p>
                </div>
            </div>
        </aside>

        {{-- ======================== MAIN ======================== --}}
        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
            
            {{-- Header (Mobile Top Bar) --}}
            <header class="md:hidden flex items-center justify-between bg-white border-b border-slate-200 px-4 py-3 shrink-0 z-20">
                <button @click="sidebarOpen = true" class="w-10 h-10 flex items-center justify-center bg-slate-50 rounded-xl border border-slate-100">
                    <i class="bi bi-list text-xl"></i>
                </button>
                <span class="text-sm font-black text-slate-800 uppercase tracking-widest">Admin Panel</span>
                <div class="w-10"></div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8 lg:p-10">
                
                {{-- Desktop Title Section --}}
                <div class="hidden md:flex items-center justify-between gap-3 mb-10">
                    <div class="min-w-0">
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Kelola Aspirasi 🛠️</h2>
                        <p class="text-slate-500 font-medium mt-0.5">Tinjau dan tanggapi aspirasi dari siswa secara real-time.</p>
                    </div>
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-2xl px-4 py-2 shadow-sm shrink-0">
                        <i class="bi bi-person-fill-gear text-blue-600"></i>
                        <span class="text-sm font-bold text-slate-700 truncate max-w-[150px]">{{ Auth::user()->name }}</span>
                    </div>
                </div>

                {{-- Flash Messages --}}
                @if(session('success') || session('error'))
                <div class="mb-6">
                    @if(session('success'))
                    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl px-4 py-3 font-semibold text-sm">
                        <i class="bi bi-check-circle-fill"></i><span>{{ session('success') }}</span>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 rounded-2xl px-4 py-3 font-semibold text-sm">
                        <i class="bi bi-x-circle-fill"></i><span>{{ session('error') }}</span>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Stats Grid --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-8">
                    @php
                        $stats = [
                            ['label'=>'Total',    'icon'=>'bi-inbox-fill',    'color'=>'blue',    'count'=>$aspirasi->count()],
                            ['label'=>'Pending',  'icon'=>'bi-clock-fill',    'color'=>'amber',   'count'=>$aspirasi->where('status','pending')->count()],
                            ['label'=>'Diproses', 'icon'=>'bi-hourglass-split','color'=>'sky',     'count'=>$aspirasi->where('status','proses')->count()],
                            ['label'=>'Selesai',  'icon'=>'bi-check2-circle', 'color'=>'emerald', 'count'=>$aspirasi->where('status','selesai')->count()],
                        ];
                    @endphp
                    @foreach($stats as $s)
                    <div class="bg-white p-4 md:p-5 rounded-3xl border border-slate-200 shadow-sm flex items-center gap-3 transition-all hover:border-{{ $s['color'] }}-300 group">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-{{ $s['color'] }}-50 text-{{ $s['color'] }}-600 rounded-xl flex items-center justify-center text-lg md:text-xl group-hover:scale-110 transition-transform shrink-0">
                            <i class="bi {{ $s['icon'] }}"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $s['label'] }}</p>
                            <p class="text-xl md:text-2xl font-black text-slate-900 leading-none mt-0.5">{{ sprintf('%02d', $s['count']) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Filter Active Badge --}}
                @if(request('category'))
                @php $activeCat = $categories->firstWhere('slug', request('category')); @endphp
                @if($activeCat)
                <div class="mb-5 flex items-center gap-2">
                    <span class="inline-flex items-center gap-2 bg-slate-900 text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-wider">
                        <i class="bi bi-tag-fill"></i> {{ $activeCat->name }}
                        <a href="{{ route('admin.dashboard') }}" class="ml-1 opacity-60 hover:opacity-100 transition-opacity"><i class="bi bi-x-lg text-[8px]"></i></a>
                    </span>
                </div>
                @endif
                @endif

                {{-- Mobile Tab Pills --}}
                <div class="flex md:hidden gap-2 overflow-x-auto pb-4 -mx-4 px-4 no-scrollbar">
                    @foreach(['semua'=>'Semua','pending'=>'Pending','proses'=>'Proses','selesai'=>'Selesai'] as $k=>$v)
                    <button @click="tab='{{ $k }}'"
                        :class="tab==='{{ $k }}' ? 'bg-blue-600 text-white' : 'bg-white text-slate-500 border border-slate-200'"
                        class="shrink-0 text-xs font-black px-5 py-2.5 rounded-full transition-all whitespace-nowrap shadow-sm">
                        {{ $v }}
                    </button>
                    @endforeach
                </div>

                {{-- Table Section --}}
                <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                    <div x-show="tab==='semua'" x-transition>
                        @include('admin.partials.table', ['data'=>$aspirasi, 'emptyMsg'=>'Belum ada aspirasi masuk.'])
                    </div>
                    <div x-show="tab==='pending'" x-transition x-cloak>
                        @include('admin.partials.table', ['data'=>$aspirasi->where('status','pending'), 'emptyMsg'=>'Tidak ada aspirasi pending.'])
                    </div>
                    <div x-show="tab==='proses'" x-transition x-cloak>
                        @include('admin.partials.table', ['data'=>$aspirasi->where('status','proses'), 'emptyMsg'=>'Tidak ada aspirasi yang sedang diproses.'])
                    </div>
                    <div x-show="tab==='selesai'" x-transition x-cloak>
                        @include('admin.partials.table', ['data'=>$aspirasi->where('status','selesai'), 'emptyMsg'=>'Belum ada aspirasi yang selesai.'])
                    </div>
                </div>

            </main>
        </div>

        {{-- ======================== MODAL ======================== --}}
        <div x-show="modalOpen" x-cloak
             class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-0 sm:p-4"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0">

            <div @click="modalOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" x-transition:opacity></div>

            <div class="relative bg-white w-full sm:max-w-lg rounded-t-[2rem] sm:rounded-[2rem] shadow-2xl overflow-hidden z-10"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="translate-y-full sm:translate-y-0 sm:scale-95">

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest mb-1">Update Status</p>
                            <h3 class="text-white font-black text-base leading-tight truncate" x-text="selectedTitle"></h3>
                        </div>
                        <button @click="modalOpen = false" class="text-white/70 hover:text-white shrink-0"><i class="bi bi-x-lg"></i></button>
                    </div>
                </div>

                <form :action="`/admin/aspirasi/${selectedId}/status`" method="POST" class="p-6 md:p-8 space-y-5">
                    @csrf @method('PATCH')
                    
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3">Ubah Status</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach(['pending'=>'amber','proses'=>'sky','selesai'=>'emerald'] as $st => $col)
                            <label class="cursor-pointer">
                                <input type="radio" name="status" value="{{ $st }}" class="sr-only peer" x-model="selectedStatus">
                                <div class="border-2 border-slate-100 rounded-2xl p-3 text-center transition-all peer-checked:border-{{ $col }}-400 peer-checked:bg-{{ $col }}-50">
                                    <i class="bi bi-{{ $st === 'pending' ? 'clock-fill' : ($st === 'proses' ? 'hourglass-split' : 'check2-circle') }} text-lg text-{{ $col }}-500"></i>
                                    <p class="text-[10px] font-black text-slate-700 mt-1 uppercase">{{ $st }}</p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Tanggapan</label>
                        <textarea name="admin_response" x-model="selectedResponse" rows="4" placeholder="Tulis tanggapan untuk siswa..."
                            class="w-full border-2 border-slate-100 rounded-2xl px-4 py-3 text-sm focus:border-blue-400 outline-none transition-all resize-none"></textarea>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="modalOpen = false" class="flex-1 py-3 bg-slate-100 text-slate-600 rounded-2xl text-sm font-bold">Batal</button>
                        <button type="submit" class="flex-1 py-3 bg-blue-600 text-white rounded-2xl text-sm font-bold shadow-lg shadow-blue-200">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>