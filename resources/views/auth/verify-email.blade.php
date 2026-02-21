<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email – SuaraSiswa</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    {{-- Panggil Navbar Baru Lo --}}
    @include('auth.layouts.navbar')

    <main class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12">
        
        <div class="w-full max-w-md text-center">
            
            {{-- Ilustrasi Mini --}}
            <div class="relative mb-8">
                <div class="w-24 h-24 bg-blue-600/10 rounded-full flex items-center justify-center mx-auto text-blue-600 text-4xl">
                    <i class="bi bi-patch-check-fill animate-bounce"></i>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full border-4 border-white flex items-center justify-center text-white text-xs">
                    <i class="bi bi-send"></i>
                </div>
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-3">Cek Email Kamu!</h1>
            
            <p class="text-slate-500 text-sm leading-relaxed mb-8 px-2">
                Terima kasih sudah mendaftar! Sebelum lanjut, tolong verifikasi email kamu melalui link yang baru saja kami kirimkan. Belum terima email? Cek folder spam atau klik tombol di bawah.
            </p>

            {{-- Status Alert --}}
            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 text-xs font-bold flex items-center gap-3 animate-fade-in-up">
                    <i class="bi bi-check-all text-xl"></i>
                    <span>Link verifikasi baru telah dikirim ke alamat email Anda!</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 p-8 sm:p-10">
                <div class="flex flex-col gap-4">
                    
                    {{-- Form Resend --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-blue-200">
                            <i class="bi bi-arrow-repeat text-lg"></i>
                            Kirim Ulang Email
                        </button>
                    </form>

                    {{-- Link Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 text-sm font-bold text-slate-400 hover:text-red-500 transition-colors flex items-center justify-center gap-2">
                            <i class="bi bi-box-arrow-left"></i>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>

            <p class="mt-10 text-slate-400 text-[10px] uppercase tracking-[0.2em] font-bold">
                SMK Negeri 5 Telkom Banda Aceh
            </p>
        </div>
    </main>

</body>
</html>