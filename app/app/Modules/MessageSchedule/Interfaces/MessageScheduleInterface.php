<?php

namespace App\Modules\MessageSchedule\Interfaces;

interface MessageScheduleInterface
{
    public function now(int $seconds = 0): string;
    public function getDispatchDate(string $timestamp, string $timezone):string;
    public function getDifferenceTimesInSeconds(string $largeDate): int;
}
