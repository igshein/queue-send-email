<?php

use App\Modules\Common\Interfaces\CommonInterface;
use App\Modules\Message\Models\Message;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use Illuminate\Database\Seeder;

class MessageScheduleSeeder extends Seeder
{
    private $messageSchedule;
    private $commonService;

    public function __construct(MessageScheduleInterface $messageSchedule, CommonInterface $common)
    {
        $this->messageSchedule = $messageSchedule;
        $this->commonService = $common;
    }

    public function run()
    {
        $timezoneLists = ['Europe/London', 'Europe/Amsterdam', 'Europe/Kiev'];

        $messageSchedulers = MessageSchedule::all();
        if (count($messageSchedulers) < MessageSeeder::MAX) {
            $messages = Message::all();
            foreach($messages as $message) {
                $dateTime = $this->commonService->now(rand(10, 60));
                $timezone = $timezoneLists[rand(0, 2)];
                MessageSchedule::insert([
                    'message_id'     => $message->message_id,
                    'request_date'   => $dateTime,
                    'timezone'       => $timezone,
                    'dispatch_date'  => $this->messageSchedule->getDispatchDate($dateTime, $timezone),
                ]);
            }
        }
    }
}
