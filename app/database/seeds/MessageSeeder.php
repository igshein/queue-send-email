<?php

use Illuminate\Database\Seeder;
use App\Modules\Message\Models\Message;

class MessageSeeder extends Seeder
{
    public const MAX = 10000;

    public function run()
    {
        $countMessages = Message::count();
        if ($countMessages < self::MAX) {
            for ($i=1; $i<=self::MAX; $i++) {
                $messages[] = [
                    'message_content' => "Test message $i",
                ];
            }
            foreach (array_chunk($messages, (self::MAX/10)) as $message) {
                Message::insert($message);
            }
        }
        unset($messages);
        unset($message);
    }
}
