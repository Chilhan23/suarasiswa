@include('errors.layout', [
    'code'=>405,'accent'=>'#4ade80','accent2'=>'#16a34a',
    'label'=>'METHOD NOT ALLOWED',
    'headline'=>'CARANYA SALAH,<br>BUKAN JALANNYA.',
    'description'=>'Route ini ada, tapi <span style="color:#86efac;font-weight:800;">method HTTP-nya beda.</span><br>Kayak masuk pintu keluar — ada, tapi salah arah.',
    'footer'=>'Developer: cek method route kamu (GET/POST/PUT/PATCH/DELETE).',
])
