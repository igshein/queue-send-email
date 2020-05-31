<?php

namespace App\Modules\MessageSchedule\Services;

use App\Modules\MessageSchedule\Interfaces\MessageScheduleInterface;
use Carbon\Carbon;

class MessageScheduleService implements MessageScheduleInterface
{
    public function now(int $seconds = 0): string
    {
        return Carbon::now()->timezone(env('DB_TIME_ZONE'))->addSeconds($seconds)->format('Y-m-d H:i:s');
    }

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
}
