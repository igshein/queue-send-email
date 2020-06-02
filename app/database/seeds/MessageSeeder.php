<?php

use App\Modules\Common\Interfaces\CommonInterface;
use App\Modules\Message\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public const MAX = 10;

    private $commonService;

    public function __construct(CommonInterface $common)
    {
        $this->commonService = $common;
    }

    public function run()
    {
        $message = Message::all();
        if (count($message) < self::MAX) {
            for ($i=0; $i<self::MAX; $i++) {
                $randCustomerID = rand(1, self::MAX);
                Message::insert([
                    'customer_id' => $randCustomerID,
                    'message'     => "Test message. Customers ID=$randCustomerID. " . time(),
                    'date_create' => $this->commonService->now()
                ]);
            }
        }
    }
}
