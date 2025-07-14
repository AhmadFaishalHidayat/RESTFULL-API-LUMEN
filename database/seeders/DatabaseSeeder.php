<?php

namespace Database\Seeders;

// use App\Models\Post;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        // Post::truncate(); // Hapus semua data sebelum isi ulang

        // foreach (range(1, 20) as $i) {
        //     Post::create([
        //         'title' => "Judul Post ke-$i",
        //         'content' => "Ini konten dari post nomor $i. Belajar Lumen sangat menyenangkan!"
        //     ]);
        // }

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
