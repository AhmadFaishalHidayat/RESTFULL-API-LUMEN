<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'admin1',
                'email' => 'admin1@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin2',
                'email' => 'admin2@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin3',
                'email' => 'admin3@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin4',
                'email' => 'admin4@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin5',
                'email' => 'admin5@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin6',
                'email' => 'admin6@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin7',
                'email' => 'admin7@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin8',
                'email' => 'admin8@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin9',
                'email' => 'admin9@mail.com',
                'password' => app('hash')->make('123456'),
            ],
            [
                'name' => 'admin10',
                'email' => 'admin10@mail.com',
                'password' => app('hash')->make('123456'),
            ],
        ];
        foreach ($users as $user) {
            User::create(['name' => $user['name'], 'email' => $user['email'], 'password' => $user['password']]);
        }

        $this->command->info(count($users) . ' Users seeded successfully.');
    }
}
