@include('errors.layout', [
    'code'=>429,'accent'=>'#fb923c','accent2'=>'#ea580c',
    'label'=>'TOO MANY REQUESTS',
    'headline'=>'SANTAI DULU,<br>JANGAN BURU-BURU.',
    'description'=>'Terlalu banyak request dalam waktu singkat.<br>Server kita bukan <span style="color:#fdba74;font-weight:800;">mesin balap.</span> Tunggu sebentar.',
    'footer'=>'Tunggu beberapa menit lalu coba lagi.',
    'extraLink'=>'<a href="javascript:location.reload()" class="nl" style="grid-column:span 2;border-color:rgba(251,146,60,.25);background:rgba(251,146,60,.07);"><span class="d"></span> Coba Lagi</a>',
])
