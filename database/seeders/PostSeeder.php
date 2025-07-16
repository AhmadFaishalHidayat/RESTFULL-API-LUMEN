<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Locale Indonesia

        // Implementasi untuk membuat 20 data post menggunakan Faker agar menggunakan bahasa Indonesia
        $titles = [
            "Cara Efektif Belajar Pemrograman untuk Pemula",
            "Mengapa Dokumentasi Sangat Penting dalam Coding",
            "Perbedaan Antara API dan REST API",
            "Langkah Mudah Membuat REST API dengan Lumen",
            "Tips Mengelola Proyek Web dengan Git",
            "Pentingnya Version Control dalam Pengembangan Aplikasi",
            "Mengenal Konsep MVC dalam Framework",
            "Cara Deploy Aplikasi Lumen ke Hosting",
            "Kesalahan Umum Saat Belajar Coding dan Cara Menghindarinya",
            "Kapan Waktu Terbaik untuk Refactor Code",
            "Manfaat Menggunakan Seeder di Laravel/Lumen",
            "Cara Menghubungkan Lumen dengan Database MySQL",
            "Belajar CRUD API dengan Laravel Lumen",
            "Pengertian dan Fungsi Middleware dalam Lumen",
            "Langkah-langkah Membuat Validasi Form di Lumen",
            "Mengapa Testing Penting dalam Pengembangan Aplikasi",
            "Belajar Debugging yang Efektif",
            "Cara Membuat Struktur Folder yang Rapi di Lumen",
            "Penggunaan .env dalam Project Laravel/Lumen",
            "Tips Belajar Programming Secara Konsisten",
            "Perbedaan antara Laravel dan Lumen",
            "Cara Membuat Route yang Dinamis di Lumen",
            "Pentingnya RESTful Design dalam API",
            "Cara Membuat Seeder Otomatis dengan Faker",
            "Langkah Membuat API Authentication di Lumen",
            "Pentingnya Keamanan API Endpoint",
            "Belajar JSON dan Penggunaannya di API",
            "Mengenal HTTP Method: GET, POST, PUT, DELETE",
            "Cara Mengatur CORS di Laravel Lumen",
            "Mengenal Status Code dalam HTTP Response",
            "Cara Menampilkan Data JSON dari Database",
            "Penerapan Pagination di REST API",
            "Membuat Struktur API yang Mudah Dipahami",
            "Tips Menulis Kode yang Clean dan Maintainable",
            "Belajar Membaca Dokumentasi Framework",
            "Cara Integrasi Lumen dengan Postman untuk Testing",
            "Langkah Membangun API Multi-User",
            "Cara Membuat Soft Delete di Lumen",
            "Menangani Error Handling Secara Elegan",
            "Cara Setup Environment Lokal untuk Project Laravel",
            "Pentingnya Backup Database dalam Proyek",
            "Cara Migrasi Database dengan Artisan",
            "Tips Belajar PHP untuk Developer JavaScript",
            "Perbedaan GET vs POST dalam Request API",
            "Cara Bekerja dengan Relasi Antar Tabel di Lumen",
            "Apa Itu Model dan Controller di MVC",
            "Cara Mengatur Timestamp Otomatis di Migration",
            "Belajar Membuat API Response yang Konsisten",
            "Cara Membuat API Versioning di Laravel Lumen",
            "Langkah Menambahkan Authentication JWT di API"
        ];

        $contents = [
            "Belajar pemrograman membutuhkan konsistensi dan latihan. Mulailah dari dasar seperti logika pemrograman sebelum lanjut ke framework.",
            "Dokumentasi sangat penting agar orang lain (dan diri sendiri di masa depan) bisa memahami kode yang telah ditulis.",
            "API adalah antarmuka komunikasi antara aplikasi, sedangkan REST API mengikuti prinsip REST seperti stateless dan endpoint yang jelas.",
            "Laravel Lumen cocok untuk membuat REST API karena ringan dan memiliki struktur minimalis yang efisien.",
            "Git sangat berguna untuk mengatur versi proyek, kolaborasi tim, dan tracking perubahan secara detail.",
            "Version control seperti Git membantu developer menghindari kehilangan progress dan mempermudah kerja tim.",
            "MVC (Model-View-Controller) adalah arsitektur yang memisahkan data, tampilan, dan logika aplikasi.",
            "Setelah aplikasi selesai dikembangkan, langkah berikutnya adalah proses deploy ke server hosting agar bisa diakses publik.",
            "Banyak pemula melakukan kesalahan seperti copy-paste tanpa paham, tidak latihan, atau langsung ke framework tanpa dasar.",
            "Refactor sebaiknya dilakukan saat kode mulai sulit dibaca, tidak efisien, atau saat menambah fitur baru.",
            "Seeder berguna untuk mengisi database dengan data awal atau dummy yang berguna saat testing atau development.",
            "Database MySQL bisa dihubungkan ke Lumen lewat pengaturan `.env` dan konfigurasi `database.php`.",
            "CRUD (Create, Read, Update, Delete) adalah dasar dalam membuat REST API yang menangani data.",
            "Middleware digunakan untuk menyaring request, seperti autentikasi atau log aktivitas.",
            "Validasi form penting untuk memastikan data yang masuk sesuai dengan yang diharapkan.",
            "Testing memastikan aplikasi berjalan sesuai harapan dan meminimalkan bug sebelum deploy.",
            "Debugging adalah proses mencari dan memperbaiki error dalam kode secara sistematis.",
            "Struktur folder yang baik mempermudah pengelolaan dan skalabilitas proyek ke depan.",
            "File `.env` menyimpan konfigurasi seperti DB, APP_URL, dan kunci rahasia secara aman.",
            "Konsistensi belajar bisa dilakukan dengan menjadwalkan waktu rutin dan project kecil.",
            "Laravel lebih lengkap dengan fitur-fitur seperti Blade, sedangkan Lumen lebih ringan dan cocok untuk API.",
            "Route dinamis bisa dibuat dengan parameter, seperti `/posts/{id}` untuk detail post.",
            "RESTful API dirancang agar mudah dipahami, konsisten, dan scalable.",
            "Dengan Faker, kamu bisa membuat data dummy seperti nama, alamat, dan teks secara otomatis.",
            "Autentikasi API berguna untuk melindungi endpoint dari akses sembarangan.",
            "Keamanan API penting dengan cara seperti validasi input, token, dan rate limiting.",
            "JSON adalah format pertukaran data ringan yang umum digunakan dalam API modern.",
            "GET mengambil data, POST mengirim data baru, PUT memperbarui, DELETE menghapus.",
            "CORS adalah mekanisme keamanan untuk membatasi akses dari domain lain.",
            "Status code seperti 200, 404, dan 500 menjelaskan hasil dari sebuah request.",
            "Mengambil data dari database lalu mengubahnya menjadi JSON sangat umum dalam API.",
            "Pagination membantu mengatur jumlah data yang ditampilkan per halaman untuk efisiensi.",
            "API yang baik memiliki struktur endpoint yang konsisten dan mudah dimengerti.",
            "Kode yang clean dan maintainable mudah dibaca, diuji, dan dikembangkan lebih lanjut.",
            "Membaca dokumentasi membantu memahami cara kerja framework dan fitur-fiturnya.",
            "Postman adalah alat populer untuk menguji API secara visual dan efisien.",
            "API multi-user membutuhkan manajemen akses dan data per user yang aman.",
            "Soft delete memungkinkan data 'dihapus' tapi masih bisa dikembalikan jika perlu.",
            "Error handling yang baik memberikan respon jelas dan aman ke pengguna.",
            "Lingkungan lokal penting disiapkan agar development bisa dilakukan secara efisien.",
            "Backup database secara rutin penting untuk menghindari kehilangan data.",
            "Migration memudahkan pengelolaan skema database secara versioned dan konsisten.",
            "Developer JS yang belajar PHP sebaiknya fokus pada logika server dan OOP.",
            "GET bersifat aman dan tidak mengubah data, sedangkan POST untuk kirim data baru.",
            "Relasi antar tabel (hasMany, belongsTo) penting untuk representasi data yang kompleks.",
            "Model mewakili data, controller menangani logika request dan response.",
            "Timestamp otomatis bisa disetting agar created_at dan updated_at diisi otomatis.",
            "API response yang konsisten membantu frontend dalam memproses data dengan stabil.",
            "API versioning memungkinkan perubahan besar tanpa mengganggu client lama.",
            "JWT (JSON Web Token) digunakan untuk autentikasi aman dan scalable di API."
        ];

        $categories = Category::all();
        $users = User::all();

        $data = []; // Ini akan menampung semua post yang dibuat

        foreach (range(1, count($titles)) as $i) {
            $post = Post::create([
                'title' => $faker->randomElement($titles),
                'content' => $faker->randomElement($contents),
                'category_id' => $faker->randomElement($categories)->id,
                'user_id' => $faker->randomElement($users)->id
            ]);
            $data[] = $post; // Masukkan post ke dalam array $data
        };

        // Tampilkan jumlah post yang berhasil dibuat
        $this->command->info(count($data) . ' data post berhasil dibuat dengan Faker!');
    }
};
