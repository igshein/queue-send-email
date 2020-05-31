<?php

use App\Modules\Customer\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $countCustomers = 10;
        $customers = Customer::all();
        if (count($customers) < $countCustomers) {
            for ($i=0; $i<$countCustomers; $i++) {
                Customer::insert([
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
