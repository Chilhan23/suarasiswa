<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Aspirasi Siswa - {{ config('app.name', 'Laravel') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'blob': 'blob 8s infinite ease-in-out',
                    'fade-in-down': 'fadeInDown 1s ease-out',
                    'fade-in-up': 'fadeInUp 1s ease-out',
                },
                keyframes: {
                    blob: {
                        '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                        '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                        '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                    },
                    fadeInDown: {
                        'from': { opacity: '0', transform: 'translateY(-30px)' },
                        'to': { opacity: '1', transform: 'translateY(0)' },
                    },
                    fadeInUp: {
                        'from': { opacity: '0', transform: 'translateY(30px)' },
                        'to': { opacity: '1', transform: 'translateY(0)' },
                    }
                }
            }
        }
    }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        .animate-blob { animation: blob 8s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out; }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50">
    @include('auth.layouts.navbar')

    {{-- BACKGROUND DECORATION (DIBUAT SLIGHTLY SUBTLE) --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100/50 rounded-full filter blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-100/50 rounded-full filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="min-h-[calc(100vh-64px)] flex relative z-10 py-12">
        
        {{-- LEFT SIDE (ILLUSTRATION) --}}
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12">
            <div class="max-w-lg text-center">
                <div class="mb-8 animate-fade-in-down flex justify-center">
                    <div class="w-24 h-24 bg-blue-600 rounded-3xl flex items-center justify-center shadow-2xl rotate-12 transform hover:rotate-0 transition-all duration-500">
                        <i class="bi bi-person-plus-fill text-white text-4xl"></i>
                    </div>
                </div>
                
                <div class="animate-fade-in-up">
                    <h1 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">
                        Bergabung Sekarang!
                    </h1>
                    <p class="text-lg text-slate-500 leading-relaxed">
                        Buat akun untuk menyampaikan aspirasi dan bantu kami membangun <span class="text-blue-600 font-bold">SMK N 5 Telkom</span> yang lebih baik.
                    </p>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE (FORM) --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
            <div class="w-full max-w-2xl">
                
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200 border border-slate-100 p-8 lg:p-10 animate-fade-in-up">
                    
                    <div class="mb-8">
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Buat Akun Siswa</h2>
                        <p class="text-slate-500 text-sm">Lengkapi data di bawah untuk akses platform</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="bi bi-person text-blue-500"></i>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm" placeholder="Nama Lengkap" required autofocus>
                                </div>
                                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="bi bi-envelope text-blue-500"></i>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm" placeholder="nama@gmail.com" required>
                                </div>
                                @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                         <div class="group">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kelas</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="bi bi-building text-blue-500"></i>
                                </div>
                                <select name="class" class="block w-full pl-11 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm appearance-none cursor-pointer" required>
                                    <option value="" disabled {{ old('class') ? '' : 'selected' }}>Pilih Kelas</option>
                                    
                                    {{-- KELAS X --}}
                                    <optgroup label="Kelas X">
                                        <option value="X PPLG 1" {{ old('class') == 'X PPLG 1' ? 'selected' : '' }}>X PPLG 1</option>
                                        <option value="X PPLG 2" {{ old('class') == 'X PPLG 2' ? 'selected' : '' }}>X PPLG 2</option>
                                        <option value="X PPLG 3" {{ old('class') == 'X PPLG 3' ? 'selected' : '' }}>X PPLG 3</option>
                                        <option value="X BP" {{ old('class') == 'X BP' ? 'selected' : '' }}>X BP</option>
                                        <option value="X TJKT 1" {{ old('class') == 'X TJKT 1' ? 'selected' : '' }}>X TJKT 1</option>
                                        <option value="X TJKT 2" {{ old('class') == 'X TJKT 2' ? 'selected' : '' }}>X TJKT 2</option>
                                        <option value="X TJKT 3" {{ old('class') == 'X TJKT 3' ? 'selected' : '' }}>X TJKT 3</option>
                                    </optgroup>

                                    {{-- KELAS XI --}}
                                    <optgroup label="Kelas XI">
                                        <option value="XI RPL 1" {{ old('class') == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                                        <option value="XI RPL 2" {{ old('class') == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                                        <option value="XI RPL 3" {{ old('class') == 'XI RPL 3' ? 'selected' : '' }}>XI RPL 3</option>
                                        <option value="XI PF 1" {{ old('class') == 'XI PF 1' ? 'selected' : '' }}>XI PF 1</option>
                                        <option value="XI PF 2" {{ old('class') == 'XI PF 2' ? 'selected' : '' }}>XI PF 2</option>
                                        <option value="XI TKJ 1" {{ old('class') == 'XI TKJ 1' ? 'selected' : '' }}>XI TKJ 1</option>
                                        <option value="XI TKJ 2" {{ old('class') == 'XI TKJ 2' ? 'selected' : '' }}>XI TKJ 2</option>
                                        <option value="XI TJA 1" {{ old('class') == 'XI TJA 1' ? 'selected' : '' }}>XI TJA 1</option>
                                        <option value="XI TJA 2" {{ old('class') == 'XI TJA 2' ? 'selected' : '' }}>XI TJA 2</option>
                                    </optgroup>

                                    {{-- KELAS XII --}}
                                    <optgroup label="Kelas XII">
                                        <option value="XII RPL" {{ old('class') == 'XII RPL' ? 'selected' : '' }}>XII RPL</option>
                                        <option value="XII TKJ" {{ old('class') == 'XII TKJ' ? 'selected' : '' }}>XII TKJ</option>
                                        <option value="XII TJA" {{ old('class') == 'XII TJA' ? 'selected' : '' }}>XII TJA</option>
                                        <option value="XII PF" {{ old('class') == 'XII PF' ? 'selected' : '' }}>XII PF</option>
                                    </optgroup>
                                </select>
                                {{-- Icon Panah --}}
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="bi bi-chevron-down text-slate-400 text-xs"></i>
                                </div>
                            </div>
                        </div>
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2">NIS</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="bi bi-card-text text-blue-500"></i>
                                    </div>
                                    <input type="text" name="nis" value="{{ old('nis') }}" class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm" placeholder="Nomor Induk Siswa" required>
                                </div>
                                @error('nis') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                                <input type="password" name="password" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm" placeholder="••••••••" required>
                                @error('password') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-sm" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl hover:bg-blue-700 transform transition-all active:scale-95 shadow-lg shadow-blue-100 mt-4 flex items-center justify-center gap-2">
                            <i class="bi bi-person-plus-fill"></i>
                            Daftar Sebagai Siswa
                        </button>

                        <div class="text-center pt-4 border-t border-slate-100">
                            <p class="text-sm text-slate-500">
                                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Login ke Platform</a>
                            </p>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</body>
</html>