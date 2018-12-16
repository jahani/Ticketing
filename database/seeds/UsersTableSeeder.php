<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => env('SEEDER_USER_NAME', 'Admin'),
            'email' => env('SEEDER_USER_EMAIL', 'admin@example.com'),
            'password' => Hash::make((env('SEEDER_USER_PASSWORD', 'password'))),
            'is_admin' => true,
        ]);

        factory(User::class, 4)->create();
    }
}
