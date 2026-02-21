<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Keamanan – SuaraSiswa</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .form-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    @include('auth.layouts.navbar')

    <main class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12">
        
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                {{-- Icon Gembok Keamanan --}}
                <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 text-2xl mx-auto mb-4 border border-amber-100 shadow-sm">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Konfirmasi Keamanan</h1>
                <p class="text-slate-500 mt-2 text-sm px-6">
                    Ini adalah area aman. Tolong masukkan password Anda untuk melanjutkan aksi ini.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 p-8 sm:p-10">
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password Anda</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="bi bi-key-fill text-lg"></i>
                            </span>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="form-input block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none transition-all" 
                                placeholder="••••••••"
                                required 
                                autocomplete="current-password"
                                autofocus>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full py-4 rounded-xl bg-slate-900 hover:bg-black text-white font-bold text-sm flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-slate-200">
                            <i class="bi bi-check-circle"></i>
                            Konfirmasi Password
                        </button>
                        
                        <a href="javascript:history.back()" class="text-center py-2 text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors">
                            Batal & Kembali
                        </a>
                    </div>
                </form>
            </div>

            <p class="text-center text-slate-400 text-[10px] uppercase tracking-[0.2em] mt-10 font-bold">
                Akses Terproteksi SuaraSiswa
            </p>
        </div>
    </main>

</body>
</html>