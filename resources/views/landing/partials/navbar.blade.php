<header class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16 gap-4">
            {{-- Logo --}}
            <a href="/" class="flex-shrink-0 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                    <i class="bi bi-megaphone-fill text-white text-sm"></i>
                </div>
                <span class="font-bold text-lg text-slate-900 tracking-tight hidden xs:block">SuaraSiswa</span>
            </a>

            {{-- NAVIGASI: Muncul di Desktop (md:flex), Hilang di HP (hidden) --}}
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-500 whitespace-nowrap">
                <a href="#" class="hover:text-blue-600 transition-colors">Beranda</a>
                <a href="#aspirasi" class="hover:text-blue-600 transition-colors">Aspirasi</a>
                <a href="#fitur" class="hover:text-blue-600 transition-colors">Fitur</a>
                <a href="#cara-kerja" class="hover:text-blue-600 transition-colors">Cara Kerja</a>
            </nav>

            {{-- AUTH BUTTONS: Tetap Muncul di HP & Laptop --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                @if(Route::has('login'))
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" 
                                class="flex items-center gap-2 bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-xl text-blue-700 text-sm font-bold transition-all border border-blue-100">
                            <i class="bi bi-person-circle text-lg"></i>
                            <span class="max-w-[70px] truncate hidden sm:inline">{{ Auth::user()->name }}</span>
                            <i class="bi bi-chevron-down text-[10px]" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-[60]">
                            <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'aspirasi.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50">
                                    <i class="bi bi-box-arrow-right"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-xs sm:text-sm font-bold text-slate-600 px-2 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="px-3 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-blue-600 text-white text-xs sm:text-sm font-bold shadow-md hover:bg-blue-700 transition-all">Daftar</a>
                @endauth
                @endif
            </div>
        </div>
    </div>
</header>