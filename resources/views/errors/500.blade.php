@include('errors.layout', [
    'code'=>500,'accent'=>'#f43f5e','accent2'=>'#be123c',
    'label'=>'INTERNAL SERVER ERROR',
    'headline'=>'SERVER KITA<br>LAGI NGAMBEK.',
    'description'=>'Ada yang <span style="color:#fda4af;font-weight:800;">error di dalam</span> — bukan salah kamu.<br>Tim lagi dikasih tau. Tunggu bentar.',
    'footer'=>'Kalau berlanjut, screenshot dan laporkan ke admin sekolah.',
    'extraLink'=>'<a href="javascript:location.reload()" class="nl" style="grid-column:span 2;border-color:rgba(244,63,94,.25);background:rgba(244,63,94,.07);"><span class="d"></span> Coba Refresh</a>',
])
