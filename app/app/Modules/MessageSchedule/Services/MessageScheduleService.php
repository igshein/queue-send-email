<?php

namespace App\Modules\MessageSchedule\Services;

use App\Jobs\CreateEmailQueue;
use App\Modules\Common\Factory\CommonServiceFactory;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use App\Modules\Timezone\Models\Timezone;
use Carbon\Carbon;

class MessageScheduleService implements MessageScheduleInterface
{
    private $commonServiceFactory;

    public function __construct()
    {
        $this->commonServiceFactory = new CommonServiceFactory;
    }

    public function createMailQueue(): void
    {
        $serverNowTimeStamp = (now())->format('Y-m-d H:i');
        $serverTimezone = env('DB_TIME_ZONE');

        $timezones = Timezone::all()->toArray();
        $current_date = Carbon::createFromFormat('Y-m-d H:i', $serverNowTimeStamp, $serverTimezone);
        foreach ($timezones as $timezone) {
            $convert_time = $current_date->setTimezone($timezone['timezone_name'])->format('H:i');
            $messages = MessageSchedule::select('message.message_content')->where('message_schedule_time', $convert_time)->leftJoin('message', 'message_schedule.message_id', '=', 'message.message_id')->get()->toArray();
            if (sizeof($messages)) {
                $data['timezone_id'] = $timezone['timezone_id'];
                $data['messages'] = $messages;
                CreateEmailQueue::dispatch($data)->onQueue('create-email-queue');
            }
        }
    }
}
