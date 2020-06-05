<?php

use Illuminate\Database\Seeder;
use App\Modules\Message\Models\Message;
use App\Modules\MessageSchedule\Models\MessageSchedule;

class MessageScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countMessageSchedule = MessageSchedule::count();
        if (empty($countMessageSchedule)) {
            $messages = Message::all();
            $countMessages = count($messages);
            foreach ($messages as $message) {
                $messagesSchedule[] = [
                    'message_id'            => mt_rand(1, ($countMessages/10)),
                    'message_schedule_time' => date("H:i", mt_rand(1250000000, 1259999999))
                ];
            }
            foreach (array_chunk($messagesSchedule, (count($messages)/10)) as $messageSchedule) {
                MessageSchedule::insert($messageSchedule);
            }
        }
        unset($messagesSchedule);
        unset($messageSchedule);
    }
}
