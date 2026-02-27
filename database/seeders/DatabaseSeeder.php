<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Aspiration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        

        // 2. ===== CATEGORIES =====
        $categoriesData = [
            ['name' => 'Fasilitas',       'slug' => 'fasilitas'],
            ['name' => 'Akademik',         'slug' => 'akademik'],
            ['name' => 'Kebersihan',       'slug' => 'kebersihan'],
            ['name' => 'Ekstrakurikuler',  'slug' => 'ekstrakurikuler'],
            ['name' => 'Teknologi',        'slug' => 'teknologi'],
            ['name' => 'Lainnya',          'slug' => 'lainnya'],
        ];

        foreach ($categoriesData as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Ambil ID kategori setelah dibuat
        $cats = Category::pluck('id', 'slug');

        // 3. ===== DUMMY ASPIRASI =====
        $aspirasi = [
            // --- PENDING ---
            [
                'user_id'        => $student2->id,
                'category_id'    => $cats['fasilitas'],
                'title'          => 'Penambahan AC di Ruang Kelas',
                'content'        => 'Ruang kelas terutama di lantai 2 sangat panas saat siang hari dan mengganggu konsentrasi belajar.',
                'status'         => 'pending',
                'created_at'     => now()->subDays(2),
            ],
            [
                'user_id'        => $student1->id,
                'category_id'    => $cats['teknologi'],
                'title'          => 'WiFi Sekolah Sering Putus',
                'content'        => 'Koneksi WiFi di area perpustakaan sering tidak stabil.',
                'status'         => 'pending',
                'created_at'     => now()->subDays(1),
            ],

            // --- PROSES ---
            [
                'user_id'        => $student1->id,
                'category_id'    => $cats['kebersihan'],
                'title'          => 'Kondisi Toilet Siswa Kurang Layak',
                'content'        => 'Toilet di gedung B lantai 1 kondisinya cukup memprihatinkan — bau dan sering tidak ada air.',
                'status'         => 'proses',
                'processed_at'   => now()->subDays(1),
                'created_at'     => now()->subDays(5),
            ],

            // --- SELESAI ---
            [
                'user_id'        => $student2->id,
                'category_id'    => $cats['fasilitas'],
                'title'          => 'Kantin Sekolah Perlu Diperluas',
                'content'        => 'Kantin sekolah sangat penuh saat jam istirahat.',
                'status'         => 'selesai',
                'admin_response' => 'Area kantin akan diperluas pada renovasi semester depan.',
                'handled_by'     => $admin->id,
                'processed_at'   => now()->subDays(3),
                'created_at'     => now()->subDays(14),
            ],
        ];

        foreach ($aspirasi as $data) {
            Aspiration::create($data);
        }
    }
}
