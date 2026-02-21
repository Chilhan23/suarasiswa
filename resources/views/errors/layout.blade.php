<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} · SuaraSiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Plus+Jakarta+Sans:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --accent:  {{ $accent  ?? '#ef4444' }};
            --accent2: {{ $accent2 ?? '#dc2626' }};
        }
        * { margin:0;padding:0;box-sizing:border-box; }

        body {
            font-family:'Plus Jakarta Sans',sans-serif;
            background:#050505;
            color:#fff;
            min-height:100vh;
            display:flex;align-items:center;justify-content:center;
            overflow:hidden;
        }

        /* ===== GLITCH ===== */
        .gnum {
            font-family:'Bebas Neue',sans-serif;
            font-size: clamp(160px,30vw,260px);
            line-height:1;
            letter-spacing:-0.02em;
            color:#fff;
            position:relative;
            display:block;
            animation: gm 3.5s infinite;
        }
        .gnum::before, .gnum::after {
            content: attr(data-text);
            font-family:'Bebas Neue',sans-serif;
            font-size:inherit;letter-spacing:inherit;
            position:absolute;top:0;left:0;width:100%;
        }
        .gnum::before { color:var(--accent); animation:gr 3.5s infinite; }
        .gnum::after  { color:#60a5fa;       animation:gb 3.5s infinite; }

        @keyframes gm {
            0%,84%,100%{transform:none;}
            85%{transform:skewX(-3deg) translateX(4px);}
            86%{transform:skewX(2deg)  translateX(-3px);}
            87%{transform:none;}
            92%{transform:translateX(-4px);}
            93%{transform:translateX(4px);}
            94%{transform:none;}
        }
        @keyframes gr {
            0%,84%,100%{opacity:0;transform:none;}
            85%{opacity:.85;transform:translateX(-9px);clip-path:polygon(0 12% ,100% 12% ,100% 32% ,0 32%);}
            86%{transform:translateX(6px);         clip-path:polygon(0 58% ,100% 58% ,100% 76% ,0 76%);}
            87%{opacity:0;}
            92%{opacity:.7;transform:translateX(10px);clip-path:polygon(0 4%  ,100% 4%  ,100% 18% ,0 18%);}
            93%{transform:translateX(-6px);        clip-path:polygon(0 72% ,100% 72% ,100% 90% ,0 90%);}
            94%{opacity:0;}
        }
        @keyframes gb {
            0%,84%,100%{opacity:0;transform:none;}
            85%{opacity:.6;transform:translateX(9px); clip-path:polygon(0 48% ,100% 48% ,100% 68% ,0 68%);}
            86%{transform:translateX(-5px);           clip-path:polygon(0 8%  ,100% 8%  ,100% 24% ,0 24%);}
            87%{opacity:0;}
            92%{opacity:.5;transform:translateX(-8px);clip-path:polygon(0 80% ,100% 80% ,100% 95% ,0 95%);}
            93%{transform:translateX(5px);            clip-path:polygon(0 28% ,100% 28% ,100% 48% ,0 48%);}
            94%{opacity:0;}
        }

        /* ===== SCANLINE ===== */
        @keyframes scan { 0%{top:-5%} 100%{top:110%} }
        .scanline {
            position:fixed;left:0;width:100%;height:100px;
            background:linear-gradient(transparent,rgba(255,255,255,0.011),transparent);
            animation:scan 8s linear infinite;
            pointer-events:none;z-index:5;
        }

        /* ===== VIGNETTE ===== */
        .vig {
            position:fixed;inset:0;
            background:radial-gradient(ellipse at center, transparent 35%, #000 100%);
            pointer-events:none;z-index:4;
        }

        /* ===== ACCENT BAR ===== */
        @keyframes bar-in { from{width:0} to{width:100%} }
        .bar {
            height:2px;
            background:linear-gradient(90deg, var(--accent), var(--accent2));
            box-shadow:0 0 24px var(--accent), 0 0 60px var(--accent2);
            animation:bar-in 0.7s cubic-bezier(0.16,1,0.3,1) 0.25s both;
            margin:0 auto 28px;
            max-width:320px;
        }

        /* ===== FADE UP ===== */
        @keyframes fu { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:none} }
        .fu    {animation:fu 0.5s ease forwards;opacity:0;}
        .fu.d1 {animation-delay:.45s}
        .fu.d2 {animation-delay:.6s}
        .fu.d3 {animation-delay:.75s}
        .fu.d4 {animation-delay:.9s}

        /* ===== NAV LINKS ===== */
        .nl {
            display:flex;align-items:center;gap:10px;
            padding:10px 14px;
            border:1px solid rgba(255,255,255,0.07);
            border-radius:12px;
            background:rgba(255,255,255,0.025);
            color:#64748b;
            font-size:12px;font-weight:700;
            text-decoration:none;
            transition:border-color .2s,background .2s,color .2s,transform .15s;
        }
        .nl:hover {
            border-color:var(--accent);
            background:rgba(255,255,255,0.055);
            color:#fff;
            transform:translateY(-2px);
        }
        .nl .d {
            width:6px;height:6px;border-radius:50%;
            background:var(--accent);
            box-shadow:0 0 8px var(--accent);
            flex-shrink:0;
        }

        /* ===== CORNER MARKS ===== */
        .cn {position:fixed;width:18px;height:18px;opacity:.2;}
        .cn::before,.cn::after{content:'';position:absolute;background:var(--accent);}
        .cn::before{width:100%;height:1px;top:0;left:0;}
        .cn::after {width:1px;height:100%;top:0;left:0;}
        .cn.tl{top:20px;left:20px;}
        .cn.tr{top:20px;right:20px;transform:rotate(90deg);}
        .cn.bl{bottom:20px;left:20px;transform:rotate(270deg);}
        .cn.br{bottom:20px;right:20px;transform:rotate(180deg);}

        /* ===== NOISE ===== */
        body::before {
            content:'';position:fixed;inset:0;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            opacity:.027;pointer-events:none;z-index:6;
        }

        @keyframes blink{0%,100%{opacity:1}50%{opacity:0}}
        .blink{animation:blink 1s step-end infinite;}
    </style>
</head>
<body>

    <div class="scanline"></div>
    <div class="vig"></div>
    <div class="cn tl"></div><div class="cn tr"></div>
    <div class="cn bl"></div><div class="cn br"></div>

    {{-- Top badge --}}
    <div style="position:fixed;top:20px;left:50%;transform:translateX(-50%);display:flex;align-items:center;gap:8px;z-index:10;">
        <span class="blink" style="width:6px;height:6px;border-radius:50%;background:var(--accent);box-shadow:0 0 10px var(--accent);display:inline-block;"></span>
        <span style="font-size:10px;font-weight:800;letter-spacing:.22em;color:#1e293b;text-transform:uppercase;">SuaraSiswa &middot; Error {{ $code }}</span>
    </div>

    {{-- CONTENT --}}
    <div style="position:relative;z-index:10;width:100%;max-width:480px;padding:0 24px;text-align:center;">

        {{-- Glitch number --}}
        <div style="position:relative;display:inline-block;margin-bottom:-8px;">
            <span class="gnum" data-text="{{ $code }}">{{ $code }}</span>
        </div>

        {{-- Bar --}}
        <div class="bar"></div>

        {{-- Text --}}
        <div class="fu d1">
            <p style="font-size:10px;font-weight:800;letter-spacing:.25em;text-transform:uppercase;color:#1e293b;margin-bottom:10px;">
                {{ $label ?? 'ERROR' }}
            </p>
            <h1 style="font-family:'Bebas Neue',sans-serif;font-size:clamp(1.8rem,5.5vw,2.8rem);letter-spacing:.06em;line-height:1.15;margin-bottom:14px;">
                {!! $headline !!}
            </h1>
            <p style="font-size:13px;font-weight:500;line-height:1.75;color:#334155;">
                {!! $description !!}
            </p>
        </div>

        {{-- Debug --}}
        {{-- @if(!empty($exception?->getMessage()) && app()->environment('local'))
        <div class="fu d2" style="margin-top:16px;padding:10px 14px;border:1px solid rgba(239,68,68,.18);border-radius:10px;background:rgba(239,68,68,.04);text-align:left;">
            <span style="font-size:10px;font-family:monospace;color:#f87171;opacity:.6;">debug › </span>
            <span style="font-size:11px;font-family:monospace;color:#f87171;">{{ $exception->getMessage() }}</span>
        </div>
        @endif --}}

        {{-- Nav --}}
        <div class="fu d3" style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:28px;text-align:left;">
            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : '/' }}" class="nl">
                <span class="d"></span> Kembali
            </a>
            <a href="/" class="nl">
                <span class="d"></span> Beranda
            </a>
            @auth
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('aspirasi.index') }}" class="nl">
                <span class="d"></span> Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="nl">
                <span class="d"></span> Login
            </a>
            @endauth
            @isset($extraLink)
            {!! $extraLink !!}
            @else
            <a href="javascript:history.back()" class="nl">
                <span class="d"></span> Coba Lagi
            </a>
            @endisset
        </div>

        <p class="fu d4" style="margin-top:28px;font-size:10px;font-weight:700;color:#0f172a;letter-spacing:.04em;">
            {{ $footer ?? '' }}
        </p>
    </div>

</body>
</html>