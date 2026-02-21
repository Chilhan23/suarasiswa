@include('errors.layout', [
    'code'=>419,'accent'=>'#fbbf24','accent2'=>'#d97706',
    'label'=>'PAGE EXPIRED',
    'headline'=>'KEBURU EXPIRE<br>HALAMANNYA.',
    'description'=>'Sesi kamu sudah <span style="color:#fde68a;font-weight:800;">kedaluwarsa.</span> Terlalu lama<br>bengong di halaman itu ya?',
    'footer'=>'Refresh dan isi ulang formnya. Ini bukan salah kamu (mungkin).',
    'extraLink'=>'<a href="javascript:history.back()" class="nl" style="grid-column:span 2;border-color:rgba(251,191,36,.25);background:rgba(251,191,36,.07);"><span class="d"></span> Refresh & Coba Lagi</a>',
])
