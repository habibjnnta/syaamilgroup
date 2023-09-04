<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


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
                'name' => "Admin",
                'email' => "admin@email.com",
                'email_verified_at' => now(),
                'password' => Hash::make("password"),
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate($user,
            ['email' => $user['email']]);
        }
    }
}
