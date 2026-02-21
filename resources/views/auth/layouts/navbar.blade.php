<header class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">
            {{-- LOGO --}}
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:rotate-12 transition-all shadow-md shadow-blue-200">
                    <i class="bi bi-megaphone-fill text-white text-sm"></i>
                </div>
                <span class="font-bold text-lg text-slate-900 tracking-tight">SuaraSiswa</span>
            </a>

            <div class="flex items-center gap-2 sm:gap-6">
                {{-- HOME LINK --}}
                <a href="/" class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">
                    <i class="bi bi-house-door text-lg sm:text-base"></i>
                    <span class="hidden sm:inline">Beranda</span>
                </a>

                {{-- DASHBOARD LINK (Hanya muncul jika sudah login) --}}
                @auth
                    <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'aspirasi.index') }}" 
                       class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">
                        <i class="bi bi-speedometer2 text-lg sm:text-base"></i>
                        <span class="hidden sm:inline">Dashboard</span>
                    </a>
                @endauth
                
                <div class="h-6 w-px bg-slate-200"></div>

                {{-- AUTH SECTION --}}
                <div class="flex items-center gap-2">
                    @auth
                        {{-- Dropdown User --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" 
                                    class="flex items-center gap-2 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl text-blue-700 text-sm font-bold transition-all border border-blue-100">
                                <i class="bi bi-person-circle text-lg"></i>
                                <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down text-[10px] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                            </button>

                            {{-- Menu Dropdown --}}
                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-[60]"
                                x-cloak>
                                
                                <div class="px-4 py-2 border-b border-slate-50 mb-1">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                        {{ Auth::user()->role === 'admin' ? 'Menu Admin' : 'Menu Siswa' }}
                                    </p>
                                </div>
                                
                                <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'aspirasi.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <i class="bi bi-grid-fill"></i> Panel Utama
                                </a>

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <i class="bi bi-person-gear"></i> Pengaturan
                                </a>

                                <hr class="my-1 border-slate-50">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                        <i class="bi bi-box-arrow-right"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Login/Register Links --}}
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-bold shadow-md shadow-blue-100 hover:bg-blue-700 transition-all active:scale-95">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>