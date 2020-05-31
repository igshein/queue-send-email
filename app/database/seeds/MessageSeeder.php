<?php

use App\Modules\Message\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MessageSeeder extends Seeder
{
    public const MAX = 10;

    public function run()
    {
        $message = Message::all();
        if (count($message) < self::MAX) {
            for ($i=0; $i<self::MAX; $i++) {
                $randCustomerID = rand(1, self::MAX);
                Message::insert([
                    'customer_id' => $randCustomerID,
                    'message'     => "Test message. Customers ID=$randCustomerID. " . time(),
                    'date_create' => Carbon::now()->timezone(env('DB_TIME_ZONE'))->format('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
