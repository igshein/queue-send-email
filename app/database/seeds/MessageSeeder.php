<?php

use Illuminate\Database\Seeder;
use App\Modules\Message\Models\Message;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $max = env('MAX_MESSAGE_SEED');

        $countMessages = Message::count();
        if ($countMessages < $max) {
            $messages = [];
            for ($i=1; $i<=$max; $i++) {
                $messages[] = [
                    'message_content' => "Test message $i",
                ];
            }
            foreach (array_chunk($messages, ($max/10)) as $message) {
                Message::insert($message);
            }
        }
        unset($messages);
        unset($message);
    }
}
