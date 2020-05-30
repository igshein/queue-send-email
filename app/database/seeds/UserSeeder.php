<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public $table = 'users';

    public function run()
    {
        if (empty(DB::table($this->table)->where('email', 'igoshein@gmail.com')->first())) {
            DB::table($this->table)->insert([
                'name' => 'admin',
                'email' => 'igoshein@gmail.com',
                'password' => Hash::make('p9pVZkzyr89Htz8awsod7Ka3'),
            ]);
        }
    }
}
