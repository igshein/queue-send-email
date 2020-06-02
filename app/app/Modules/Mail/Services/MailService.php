<?php

namespace App\Modules\Mail\Services;

use App\Modules\Common\Factory\CommonServiceFactory;
use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Models\LogsSendMessage;
use App\Modules\MessageSchedule\Models\MessageSchedule;

class MailService implements MailInterface
{
    private $commonServiceFactory;

    public function __construct()
    {
        $this->commonServiceFactory = new CommonServiceFactory;
    }

    public function send(int $messageScheduleId): void
    {
        $message = $this->selectMessageFileds($messageScheduleId);

        LogsSendMessage::insert([
            'message_id' => $message->message_id,
            'customer_id' => $message->customer_id,
            'message' => $message->message,
            'date_send' => $this->commonServiceFactory->getCommonService()->now(),
        ]);

        sleep(1); ## API response emulation
    }

    public function getLogSend(int $limit = 1000): array
    {
        return LogsSendMessage::select(
            'logs_send_message_id',
            'message_id',
            'customer_id',
            'message',
            'date_send'
        )
            ->orderBy('logs_send_message_id', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    private function selectMessageFileds(int $messageScheduleId): MessageSchedule
    {
        $message = MessageSchedule::select(
            'message_schedule.message_id',
            'message.customer_id',
            'message.message'
        )
            ->leftJoin('message', 'message.message_id', '=', 'message_schedule.message_id')
            ->where('message_schedule_id', $messageScheduleId)
            ->first();
        return $message;
    }
}
