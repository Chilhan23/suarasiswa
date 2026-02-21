<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password – SuaraSiswa</title>
    
    {{-- Pakai Vite sesuai setup lo --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font & Icon --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .form-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

     @include('auth.layouts.navbar')

    <main class="relative min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12">
        
        {{-- Blobs Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-1/4 -right-20 w-80 h-80 bg-blue-100 rounded-full filter blur-3xl opacity-60 animate-pulse"></div>
            <div class="absolute bottom-1/4 -left-20 w-80 h-80 bg-indigo-100 rounded-full filter blur-3xl opacity-60 animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-blue-600 text-2xl mx-auto mb-4 shadow-xl shadow-slate-200/50">
                    <i class="bi bi-envelope-at-fill"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Lupa Password?</h1>
                <p class="text-slate-500 mt-2 text-sm leading-relaxed px-4">
                    Jangan khawatir! Masukkan email kamu, dan kami akan kirimkan link reset password.
                </p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm font-medium flex items-center gap-3">
                    <i class="bi bi-check-circle-fill text-lg"></i>
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 p-8 sm:p-10">
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="bi bi-envelope-fill text-lg"></i>
                            </span>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="form-input block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none transition-all" 
                                placeholder="nama@email.com"
                                required 
                                autofocus>
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-blue-200">
                        <i class="bi bi-send-fill text-xs"></i>
                        Kirim Link Reset
                    </button>

                    <div class="text-center pt-2">
                        <a href="{{ route('login') }}" class="text-sm text-slate-500 font-bold hover:text-blue-600 transition-colors flex items-center justify-center gap-2">
                            <i class="bi bi-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>