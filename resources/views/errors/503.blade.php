@include('errors.layout', [
    'code'=>503,'accent'=>'#2dd4bf','accent2'=>'#0d9488',
    'label'=>'SERVICE UNAVAILABLE',
    'headline'=>'Sedang Maintenance<br>Mohon Tunggu',
    'description'=>'SuaraSiswa sedang dalam proses <span style="color:#5eead4;font-weight:800;">pemeliharaan sistem.</span><br>Kami sedang meningkatkan layanan agar lebih stabil dan aman.',
    'footer'=>'Kami akan segera kembali. Terima kasih atas kesabarannya.',
    'extraLink'=>'<a href="javascript:location.reload()" class="nl" style="grid-column:span 2;border-color:rgba(45,212,191,.25);background:rgba(45,212,191,.07);"><span class="d"></span> Cek Lagi</a>',
])