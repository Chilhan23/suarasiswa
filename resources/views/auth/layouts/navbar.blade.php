<header class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">
            
            {{-- LOGO --}}
            <a href="/" class="flex items-center gap-2 group shrink-0">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center group-hover:rotate-12 transition-all shadow-md shadow-blue-200">
                    <i class="bi bi-megaphone-fill text-white text-sm"></i>
                </div>
                <span class="font-bold text-lg text-slate-900 tracking-tight">SuaraSiswa</span>
            </a>

            {{-- DESKTOP NAV (Muncul di Laptop, Hilang di HP) --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="/" class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">
                    <i class="bi bi-house-door"></i> Beranda
                </a>
                @auth
                    <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'aspirasi.index') }}" 
                       class="flex items-center gap-1 text-sm font-semibold text-slate-500 hover:text-blue-600 transition-colors">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                @endauth
                
                <div class="h-6 w-px bg-slate-200 mx-2"></div>

                @auth
                    {{-- Dropdown User Desktop --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" 
                                class="flex items-center gap-2 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-xl text-blue-700 text-sm font-bold transition-all border border-blue-100">
                            <i class="bi bi-person-circle text-lg"></i>
                            <span class="max-w-[100px] truncate">{{ Auth::user()->name }}</span>
                            <i class="bi bi-chevron-down text-[10px]" :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-[60]">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-blue-50 transition-colors">
                                <i class="bi bi-person-gear"></i> Pengaturan
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="bi bi-box-arrow-right"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600">Masuk</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-bold shadow-md hover:bg-blue-700">Daftar</a>
                    </div>
                @endauth
            </div>

            {{-- MOBILE HAMBURGER BUTTON (Hanya muncul di HP) --}}
            <div class="flex md:hidden items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="w-10 h-10 flex items-center justify-center bg-slate-50 rounded-xl text-slate-600 border border-slate-200">
                    <i class="bi" :class="mobileMenuOpen ? 'bi-x-lg' : 'bi-list text-2xl'"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU DROPDOWN --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white border-b border-slate-100 shadow-inner px-4 py-4 space-y-3"
         x-cloak>
        
        <a href="/" class="flex items-center gap-3 p-3 rounded-xl text-slate-600 hover:bg-blue-50 font-bold">
            <i class="bi bi-house-door text-lg"></i> Beranda
        </a>

        @auth
            <a href="{{ route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'aspirasi.index') }}" class="flex items-center gap-3 p-3 rounded-xl text-slate-600 hover:bg-blue-50 font-bold">
                <i class="bi bi-speedometer2 text-lg"></i> Dashboard
            </a>
            <div class="border-t border-slate-100 pt-3">
                <div class="px-3 mb-2 flex items-center gap-2">
                    <i class="bi bi-person-circle text-blue-600"></i>
                    <span class="font-bold text-slate-900">{{ Auth::user()->name }}</span>
                </div>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 text-sm text-slate-500 hover:text-blue-600">
                    <i class="bi bi-person-gear"></i> Pengaturan
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 p-3 text-sm text-red-500">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        @else
            <div class="grid grid-cols-2 gap-3 pt-2">
                <a href="{{ route('login') }}" class="flex items-center justify-center p-3 rounded-xl bg-slate-100 text-slate-600 font-bold text-sm">Masuk</a>
                <a href="{{ route('register') }}" class="flex items-center justify-center p-3 rounded-xl bg-blue-600 text-white font-bold text-sm shadow-md shadow-blue-100">Daftar</a>
            </div>
        @endauth
    </div>
</header>