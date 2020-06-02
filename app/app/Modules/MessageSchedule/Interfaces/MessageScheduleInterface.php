<?php

namespace App\Modules\MessageSchedule\Interfaces;

interface MessageScheduleInterface
{
    public function getDispatchDate(string $timestamp, string $timezone):string;
    public function getDifferenceTimesInSeconds(string $largeDate): int;
    public function getAll(int $limit = 1000): array;
    public function createMessageSchedule(int $customerId, string $message, string $timezone, string $requestDate): void;
}
