<?php

namespace App\Modules\MessageSchedule\Interfaces;

interface MessageScheduleInterface
{
    public function createEmailQueue(int $timezoneID, array $messages): void;
//    public function sendNewMessage(array $requestData): void;
//    public function getDispatchDate(string $timestamp, string $timezone):string;
//    public function getAll(int $limit = 1000): array;
}
