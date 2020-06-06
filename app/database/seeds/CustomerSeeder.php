<?php

use App\Modules\Customer\Models\Customer;
use App\Modules\Timezone\Models\Timezone;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $max = env('MAX_CUSTOMER_SEED');

        $countCustomers = Customer::count();
        if ($countCustomers < $max) {
            $countTimezones = Timezone::count();
            for ($i=1; $i<=$max; $i++) {
                $customers[] = [
                        'customer_email' => "test$i@gmail.com",
                        'timezone_id' => rand(1, $countTimezones),
                    ];
            }
            foreach (array_chunk($customers, ($max/1000)) as $customer) {
                Customer::insert($customer);
            }
        }
        unset($customers);
        unset($customer);
    }
}
