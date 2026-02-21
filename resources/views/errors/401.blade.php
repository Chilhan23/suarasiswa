@include('errors.layout', [
    'code'=>401,'accent'=>'#a78bfa','accent2'=>'#7c3aed',
    'label'=>'UNAUTHORIZED',
    'headline'=>'Kamu Siapa?<br>NPC?',
    'description'=>'Kamu belum <span style="color:#c4b5fd;font-weight:800;">login</span> — jadi kita belum kenal.<br>Kenalan dulu dong sebelum masuk.',
    'footer'=>'Belum punya akun? Hubungi admin sekolah.',
    'extraLink'=>'<a href="'.route('login').'" class="nl" style="grid-column:span 2;border-color:rgba(167,139,250,.25);background:rgba(167,139,250,.07);"><span class="d"></span> Login Sekarang</a>',
])
