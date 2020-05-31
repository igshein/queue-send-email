<?php

use App\Modules\Message\Models\Message;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MessageScheduleSeeder extends Seeder
{
    public function run()
    {
        $timezone = ['Europe/Amsterdam', 'Europe/Kiev', 'Asia/Tbilisi'];

        $messageSchedulers = MessageSchedule::all();
        if (count($messageSchedulers) < MessageSeeder::MAX) {
            $messages = Message::all();
            foreach($messages as $message) {
                MessageSchedule::insert([
                    'message_id' => $message->message_id,
                    'dispatch_date'  => Carbon::now()->timezone(env('DB_TIME_ZONE'))->format('Y-m-d H:i:s'),
                    'timezone'   => $timezone[rand(0, 2)]
                ]);
            }
        }
    }
}
