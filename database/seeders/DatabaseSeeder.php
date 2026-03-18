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
    }
}
