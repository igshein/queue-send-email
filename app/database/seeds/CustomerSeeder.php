<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public $table = 'customer';

    public function run()
    {
        $countCustomers = 10;
        if (empty(DB::table($this->table)->where('customer_id', $countCustomers)->first())) {
            for ($i=0; $i<$countCustomers; $i++) {
                DB::table($this->table)->insert([
                    'name' => Str::random(12),
                    'email' => Str::random(24).'@gmail.com',
                    'password' => Hash::make('password'),
                    'date_create' => Carbon::now()->timezone(env('DB_TIME_ZONE'))->format('Y-m-d H:i:s'),
                    'timezone' => env('DB_TIME_ZONE')
                ]);
            }
        }
    }
}
