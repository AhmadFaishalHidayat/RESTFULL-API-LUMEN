<?php

namespace Database\Seeders;

// use App\Models\Post;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            if ($this->command->confirm('Do you want to truncate the db table?', true)) {
                // Nonaktifkan foreign key checks sementara
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');

                // Truncate tabel dengan urutan: anak -> induk
                Post::truncate();
                Role::truncate();
                Permission::truncate();
                Category::truncate();
                User::truncate();

                // Aktifkan kembali foreign key checks
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                $this->command->info('All tables truncated successfully.');
            }
        }

        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            AssignRolePermissionSeeder::class,
            PostSeeder::class,
        ]);
    }
}
