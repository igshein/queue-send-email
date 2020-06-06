<?php

namespace App\Modules\Mail\Services;

use App\Jobs\SendEmails;
use App\Modules\Common\Factory\CommonServiceFactory;
use App\Modules\Mail\Interfaces\MailInterface;
use Illuminate\Support\Facades\Log;

class MailService implements MailInterface
{
    private $commonServiceFactory;

    public function __construct()
    {
        $this->commonServiceFactory = new CommonServiceFactory;
    }

    public function createWorkSendEmail(string $email, string $content): void
    {
        //$delay = 0; ## For debug
        $data['email'] = $email;
        $data['content'] = $content;
        SendEmails::dispatch($data)/*->delay(now()->addSeconds($delay))*/->onQueue('send-mails');
    }

    public function send(string $email, string $content): void
    {
        Log::channel('email')->info('send-email | '. date('Y-m-d H:i:s') . ' | email=' . $email . ' | message=' . $content);
//        try {
//            $message = $this->selectMessageFileds($messageScheduleId);
//            sleep(0.5); ## API response emulation
//            LogsSendMessage::insert([
//                'message_id' => $message->message_id,
//                'customer_id' => $message->customer_id,
//                'message' => $message->message,
//                'date_send' => $this->commonServiceFactory->getCommonService()->now(),
//            ]);
//        } catch (\Exception $exception) {
//            Log::error("Error: email for messageScheduleId=$messageScheduleId not send: " . serialize($exception));
//            throw $exception;
//        }
    }

    public function getLogSend(int $limit = 1000): array
    {
        $arr = [];
        $path = storage_path().'/logs/email.log';
        $data = shell_exec("tail -15 $path");
        if(!empty($data)) {
            $arr = explode(PHP_EOL, $data);
        }
        return $arr;

//        return LogsSendMessage::select(
//            'logs_send_message_id',
//            'message_id',
//            'customer_id',
//            'message',
//            'date_send'
//        )
//            ->orderBy('logs_send_message_id', 'desc')
//            ->limit($limit)
//            ->get()
//            ->toArray();
    }

//    private function selectMessageFileds(int $messageScheduleId): MessageSchedule
//    {
//        $message = MessageSchedule::select(
//            'message_schedule.message_id',
//            'message.customer_id',
//            'message.message'
//        )
//            ->leftJoin('message', 'message.message_id', '=', 'message_schedule.message_id')
//            ->where('message_schedule_id', $messageScheduleId)
//            ->first();
//        return $message;
//    }
}
