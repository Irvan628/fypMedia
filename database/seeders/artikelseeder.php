<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Loop untuk membuat data artikel
        for ($i = 0; $i < 10; $i++) {
            $judul = $faker->sentence;
            $deskripsi = $faker->paragraph(3);
            $namaPenulis = $faker->name;
            $editor = $faker->name;

            // Simpan gambar dari faker ke storage
            $gambarPath = 'public/images/artikel' . ($i + 1) . '.jpg';
            $gambar = $faker->image('public/storage/images', 400, 300, null, false);
            // Ubah path gambar agar sesuai dengan yang disimpan di storage
            $gambarUrl = str_replace('public/', 'storage/', $gambarPath);

            // Simpan data artikel ke dalam database
            Artikel::create([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'nama_penulis' => $namaPenulis,
                'editor' => $editor,
                'gambar' => $gambarUrl
            ]);
        }
    }
}
