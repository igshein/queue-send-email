<?php

namespace App\Modules\Mail\Services;

use App\Modules\Common\Factory\CommonServiceFactory;
use App\Modules\Mail\Interfaces\MailInterface;
use App\Modules\MessageSchedule\Models\LogsSendMessage;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MailService implements MailInterface
{
    private $commonServiceFactory;

    public function __construct()
    {
        $this->commonServiceFactory = new CommonServiceFactory;
    }

    public function send(int $messageScheduleId): void
    {
        try {
            DB::beginTransaction();
            $message = $this->selectMessageFileds($messageScheduleId);
            sleep(0.5); ## API response emulation
            LogsSendMessage::insert([
                'message_id' => $message->message_id,
                'customer_id' => $message->customer_id,
                'message' => $message->message,
                'date_send' => $this->commonServiceFactory->getCommonService()->now(),
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error: email for messageScheduleId=$messageScheduleId not send: " . serialize($exception));
            throw $exception;
        }
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
