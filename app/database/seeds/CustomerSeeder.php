<?php

use App\Modules\Customer\Models\Customer;
use App\Modules\Timezone\Models\Timezone;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public const MAX = 1000000;

    public function run()
    {
        $countCustomers = Customer::count();
        if ($countCustomers < self::MAX) {
            $countTimezones = Timezone::count();
            for ($i=1; $i<=self::MAX; $i++) {
                $customers[] = [
                        'customer_email' => "test$i@gmail.com",
                        'timezone_id' => rand(1, $countTimezones),
                    ];
            }
            foreach (array_chunk($customers, (self::MAX/1000)) as $customer) {
                Customer::insert($customer);
            }
        }
        unset($customers);
        unset($customer);
    }
}
