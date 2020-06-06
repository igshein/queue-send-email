<?php

namespace App\Modules\MessageSchedule\Services;

use App\Jobs\CreateEmailQueue;
use App\Jobs\SendEmails;
use App\Modules\Common\Factory\CommonServiceFactory;
use App\Modules\Message\Models\Message;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MessageScheduleService implements MessageScheduleInterface
{
    private $commonServiceFactory;

    public function __construct()
    {
        $this->commonServiceFactory = new CommonServiceFactory;
    }

    public function createEmailQueue(int $timezoneID, array $messages): void
    {
        $delay = 0; ## For Debug
        $data['timezone_id'] = $timezoneID;
        $data['messages'] = $messages;
        CreateEmailQueue::dispatch($data)/*->delay(now()->addSeconds($delay))*/->onQueue('create-email-queue');
    }

//    public function sendNewMessage(array $requestData): void
//    {
//        try {
//            DB::beginTransaction();
//            $requestData['message_id'] = $this->createMessage($requestData);
//            $messageSchedule = $this->createMessageSchedule($requestData);
//            DB::commit();
//        } catch (\Exception $exception) {
//            DB::rollBack();
//            throw $exception;
//        }
//
//        $delay = $this->getDelay($messageSchedule);
//        SendEmails::dispatch($messageSchedule->id)->delay(now()->addSeconds($delay));
//    }
//
//    public function getDispatchDate(string $dateTime, string $timezone): string
//    {
//        $date = Carbon::createFromFormat('Y-m-d H:i:s', $dateTime, $timezone);
//        $date->setTimezone(env('DB_TIME_ZONE'));
//
//        if ($date->gt($this->commonServiceFactory->getCommonService()->now())) {
//            return $date;
//        } else {
//            throw new \Exception('Error: request date is less than current date');
//        }
//    }
//
//    public function getAll(int $limit = 1000): array
//    {
//        return MessageSchedule::select(
//            "message_schedule.message_schedule_id",
//            "message.message",
//            "message_schedule.request_date",
//            "message_schedule.timezone",
//            "message_schedule.dispatch_date"
//        )
//            ->leftJoin('message', 'message.message_id', '=', 'message_schedule.message_id')
//            ->orderBy('message_schedule.message_schedule_id', 'desc')
//            ->limit($limit)
//            ->get()
//            ->toArray();
//    }
//
//    private function createMessage(array $requestData): int
//    {
//        return Message::create([
//            'customer_id' => $requestData['customer_id'],
//            'message' => $requestData['message'],
//            'date_create' => $this->commonServiceFactory->getCommonService()->now()
//        ])->id;
//    }
//
//    private function createMessageSchedule(array $requestData): MessageSchedule
//    {
//        return MessageSchedule::create([
//            'message_id' => $requestData['message_id'],
//            'request_date' => $requestData['request_date'],
//            'timezone' => $requestData['timezone'],
//            'dispatch_date' => $this->getDispatchDate($requestData['request_date'], $requestData['timezone']),
//        ]);
//    }
//
//    private function getDelay(MessageSchedule $messageSchedule): int
//    {
//        $now = Carbon::now(env('DB_TIME_ZONE'));
//        $largeDate = Carbon::parse($messageSchedule['dispatch_date'], env('DB_TIME_ZONE'));
//        return $now->diffInSeconds($largeDate);
//    }
}
