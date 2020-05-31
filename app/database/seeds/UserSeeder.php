<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        if (empty(User::where('email', 'igoshein@gmail.com')->first())) {
            User::insert([
                'name' => 'admin',
                'email' => 'igoshein@gmail.com',
                'password' => Hash::make('p9pVZkzyr89Htz8awsod7Ka3'),
            ]);
        }
    }
}
