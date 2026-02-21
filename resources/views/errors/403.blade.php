@php
    $ctx = session('403_ctx') ?? session('403_context');

    if ($ctx === 'admin_ke_student') {
        $label       = 'FORBIDDEN';
        $headline    = 'Kamu sudah jadi admin<br>mau jadi siswa lagi? :(';
        $description = 'Jangan ya min, ngapain jadi siswa? <span style="color:#fca5a5;font-weight:800;">Dashboard siswa bukan urusan admin yaa.</span> Aktivitas ini tercatat juga kok min.';
        $footer      = 'Balik ke dashboard admin dan lakukan tugasmu. 👋';
    } elseif ($ctx === 'student_ke_admin') {
        $label       = 'FORBIDDEN';
        $headline    = 'Wah, berani banget<br>masuk sini. 😹';
        $description = 'Forbidden zone. <span style="color:#fca5a5;font-weight:800;">Unauthorized entity detected.</span> Aktivitas lu tercatat. Stop sebelum makin deep.';
        $footer      = 'Nice attempt, tapi tetap denied. 👋';
    } else {
        $label       = 'FORBIDDEN';
        $headline    = 'Wah, berani banget<br>masuk sini.';
        $description = 'Area ini <span style="color:#fca5a5;font-weight:800;">bukan buat kamu.</span> Entah nyasar atau emang sengaja — dua-duanya tetap <span style="color:#fca5a5;font-weight:800;">ditolak.</span>';
        $footer      = 'Kalau emang sengaja — good try. 👋';
    }
@endphp

@include('errors.layout', [
    'code'        => 403,
    'accent'      => '#f87171',
    'accent2'     => '#dc2626',
    'label'       => $label,
    'headline'    => $headline,
    'description' => $description,
    'footer'      => $footer,
])