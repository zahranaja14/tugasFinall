<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'nama_menu' => 'Susu Murni Original',
                'deskripsi' => 'Rasa asli, segar dan alami',
                'harga' => 8000,
                'kategori' => 'minuman',
                'gambar' => null,
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Susu Murni Coklat',
                'deskripsi' => 'Coklat premium manis legit',
                'harga' => 10000,
                'kategori' => 'minuman',
                'gambar' => null,
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Susu Murni Stroberi',
                'deskripsi' => 'Segarnya buah strawberry',
                'harga' => 10000,
                'kategori' => 'minuman',
                'gambar' => null,
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Susu Murni Vanila',
                'deskripsi' => 'Aroma vanila lembut',
                'harga' => 10000,
                'kategori' => 'minuman',
                'gambar' => null,
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Susu Murni Melon',
                'deskripsi' => 'Rasa melon menyegarkan',
                'harga' => 10000,
                'kategori' => 'minuman',
                'gambar' => null,
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Susu Matcha',
                'deskripsi' => 'Susu murni original yang ditambahkan rasa pahitnya matcha',
                'harga' => 14000,
                'kategori' => 'minuman',
                'gambar' => null,
                'tersedia' => true,
            ],
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::create($menu);
        }
    }
}
