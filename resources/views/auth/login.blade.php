<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk – SMK N 5 Telkom Banda Aceh</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script>
    tailwind.config = {
        theme: {
            extend: {
                animation: {
                    'blob': 'blob 8s infinite ease-in-out',
                    'fade-in-down': 'fadeInDown 0.8s ease-out forwards',
                    'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                },
                keyframes: {
                    blob: {
                        '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                        '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                        '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                    },
                    fadeInDown: {
                        '0%': { opacity: '0', transform: 'translateY(-20px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' },
                    },
                    fadeInUp: {
                        '0%': { opacity: '0', transform: 'translateY(20px)' },
                        '100%': { opacity: '1', transform: 'translateY(0)' },
                    }
                }
            }
        }
    }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .form-input { transition: all 0.2s ease; }
        .form-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        .btn-blue {
            background: #2563EB;
            transition: all 0.2s ease;
        }
        .btn-blue:hover {
            background: #1D4ED8;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        .animate-fade-in-down { animation: fadeInDown 0.8s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-blob { animation: blob 8s infinite ease-in-out; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

      @include('auth.layouts.navbar')

    <main class="relative min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12">
        
        <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-1/4 -right-20 w-80 h-80 bg-blue-100 rounded-full filter blur-3xl opacity-60 animate-blob"></div>
            <div class="absolute bottom-1/4 -left-20 w-80 h-80 bg-indigo-100 rounded-full filter blur-3xl opacity-60 animate-blob" style="animation-delay: 4s;"></div>
        </div>

        <div class="w-full max-w-md">
            <div class="text-center mb-8 animate-fade-in-down">
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-xl shadow-blue-200">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h1>
                <p class="text-slate-500 mt-2 font-medium">Silakan masuk untuk mulai beraspirasi</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 p-8 sm:p-10 animate-fade-in-up">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="user_cred" class="block text-sm font-bold text-slate-700 mb-2">Email / NIS</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="bi bi-person-circle text-lg"></i>
                            </span>
                            <input 
                                id="user_cred" 
                                type="text" 
                                name="user_cred" 
                                value="{{ old('user_cred') }}"
                                class="form-input block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none" 
                                placeholder="Masukkan identitas Anda"
                                required 
                                autofocus>
                        </div>
                        @error('user_cred')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-blue-600 hover:underline">Lupa Password?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="bi bi-key-fill text-lg"></i>
                            </span>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="form-input block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none" 
                                placeholder="••••••••"
                                required>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                        <label for="remember_me" class="ml-2 text-sm text-slate-600 cursor-pointer select-none">Ingat saya di perangkat ini</label>
                    </div>

                    <button type="submit" class="btn-blue w-full py-4 rounded-xl text-white font-bold text-sm flex items-center justify-center gap-2 transform active:scale-95 transition-all">
                        <i class="bi bi-box-arrow-in-right text-lg"></i>
                        Masuk ke Dashboard
                    </button>

                    <div class="text-center pt-2">
                        <p class="text-sm text-slate-500 font-medium">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-blue-600 font-extrabold hover:underline">Daftar Sekarang</a>
                        </p>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-400 text-[10px] uppercase tracking-[0.2em] mt-10 font-bold animate-fade-in-up" style="animation-delay: 0.3s;">
                SMK Negeri 5 Telkom Banda Aceh
            </p>
        </div>
    </main>

</body>
</html>