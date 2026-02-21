<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SuaraSiswa – SMK N 5 Telkom Banda Aceh</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <style>
        body { font-family: 'Inter', sans-serif; }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.show { opacity: 1; transform: translateY(0); }
        .reveal.d1 { transition-delay: 0.1s; }
        .reveal.d2 { transition-delay: 0.2s; }
        .reveal.d3 { transition-delay: 0.3s; }

        @keyframes floaty {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .float { animation: floaty 4s ease-in-out infinite; }

        .btn-blue {
            background: #2563EB;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        }
        .btn-blue:hover {
            background: #1D4ED8;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.35);
        }
    </style>
</head>
<body class="bg-white text-slate-900">

    {{-- Navbar --}}
    @include('landing.partials.navbar')

    {{-- Hero --}}
    @include('landing.partials.hero')

    {{-- Aspirasi Terbaru --}}
    @include('landing.partials.aspirasi')

    {{-- About --}}
    @include('landing.partials.suarasiswa')

    {{-- Cara Kerja --}}
    @include('landing.partials.works')
    
    {{-- Footer --}}
    @include('landing.partials.footer')
    
    <script>
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('show'); } });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
    </script>
</body>
</html>