<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password – SuaraSiswa</title>
    
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
                <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-2xl mx-auto mb-4 shadow-xl shadow-blue-200">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Password Baru</h1>
                <p class="text-slate-500 mt-2 font-medium">Buat password yang kuat dan mudah diingat</p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 p-8 sm:p-10">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <i class="bi bi-envelope-at"></i>
                            </span>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email', $request->email) }}"
                                class="form-input block w-full pl-11 pr-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-sm text-slate-500 outline-none cursor-not-allowed" 
                                readonly 
                                required>
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="bi bi-key-fill text-lg"></i>
                            </span>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="form-input block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none" 
                                placeholder="Minimal 8 karakter"
                                required 
                                autocomplete="new-password">
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="bi bi-check2-all text-lg"></i>
                            </span>
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                name="password_confirmation" 
                                class="form-input block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none" 
                                placeholder="Ulangi password"
                                required 
                                autocomplete="new-password">
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-blue-200">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Password Baru
                    </button>
                </form>
            </div>

            <p class="text-center text-slate-400 text-[10px] uppercase tracking-[0.2em] mt-10 font-bold">
                Keamanan Akun SuaraSiswa
            </p>
        </div>
    </main>

</body>
</html>