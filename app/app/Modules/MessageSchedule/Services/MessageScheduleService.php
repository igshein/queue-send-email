<?php

namespace App\Modules\MessageSchedule\Services;

use App\Jobs\SendEmails;
use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use App\Modules\MessageSchedule\Models\MessageSchedule;
use Carbon\Carbon;

class MessageScheduleService implements MessageScheduleInterface
{
    public function getDispatchDate(string $timestamp, string $timezone): string
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp, $timezone);
        $date->setTimezone(env('DB_TIME_ZONE'));
        return $date;
    }

    public function getDifferenceTimesInSeconds(string $largeDate): int
    {
        $now = Carbon::now(env('DB_TIME_ZONE'));
        $largeDate = Carbon::parse($largeDate, env('DB_TIME_ZONE'));
        return $now->diffInSeconds($largeDate);
    }

    public function createMessageSchedule(int $customerId, string $message, string $timezone, string $requestDate): void
    {
        $messageScheduleID = 2;
        $delay = 0;
        SendEmails::dispatch($messageScheduleID)->delay(now()->addSeconds($delay));
    }

    public function getAll(int $limit = 1000): array
    {
        return MessageSchedule::select(
            "message_schedule.message_schedule_id",
            "message.message",
            "message_schedule.request_date",
            "message_schedule.timezone",
            "message_schedule.dispatch_date"
        )
            ->leftJoin('message', 'message.message_id', '=', 'message_schedule.message_id')
            ->orderBy('message_schedule.message_schedule_id', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
