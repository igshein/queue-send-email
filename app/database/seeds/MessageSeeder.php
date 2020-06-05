<?php

use App\Modules\Common\Interfaces\CommonInterface;
use App\Modules\Message\Models\Message;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public const MAX = 10;

    private $messageSchedule;
    private $commonService;
    private $timezoneLists = ['Europe/London', 'Europe/Amsterdam', 'Europe/Kiev'];

    public function __construct(MessageScheduleInterface $messageSchedule, CommonInterface $common)
    {
        $this->messageSchedule = $messageSchedule;
        $this->commonService = $common;
    }

    public function run()
    {
//        message_id      int unsigned auto_increment
//        message_content text not null
        $message = Message::all();
        if (count($message) < self::MAX) {
            for ($i=0; $i<self::MAX; $i++) {
                $randCustomerID = rand(1, self::MAX);
                $requestData['customer_id'] = $randCustomerID;
                $requestData['message'] = 'Seed test message ' . time();
                $requestData['timezone'] = $this->timezoneLists[rand(0, 2)];
                $requestData['request_date'] = $this->commonService->now(rand(10, 60));
                $this->messageSchedule->sendNewMessage($requestData);
            }
        }
    }
}
