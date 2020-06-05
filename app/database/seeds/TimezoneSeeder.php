<?php

use App\Modules\Customer\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TimezoneSeeder extends Seeder
{
    public function run()
    {
        $max = 10000;
        $customers = Customer::all()->toArray();
        if (count($customers) < $max) {
            for ($i = 1; $i <= $max; $i++) {
                $customers[] = [
                    'customer_email' => "test$i@gmail.com",
                    'customer_timezone' => 'Europe/Kiev',
                ];
            }
            foreach (array_chunk($customers, ($max / 10)) as $customer) {
                Customer::insert($customer);
            }
        }
        unset($customers);
        unset($customer);
    }
}
