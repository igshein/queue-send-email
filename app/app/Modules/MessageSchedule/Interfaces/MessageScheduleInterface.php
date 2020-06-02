<?php

namespace App\Modules\MessageSchedule\Interfaces;

interface MessageScheduleInterface
{
    public function sendNewMessage(array $requestData): void;
    public function getDispatchDate(string $timestamp, string $timezone):string;
    public function getDifferenceTimesInSeconds(string $largeDate): int;
    public function getAll(int $limit = 1000): array;
}
