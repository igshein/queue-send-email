<?php

namespace App\Modules\MessageSchedule\Interfaces;

interface MessageScheduleInterface
{
    public function getDispatchDate(string $timestamp, string $timezone):string;
    public function getDifferenceTimesInSeconds(string $largeDate): int;
}
