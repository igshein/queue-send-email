<?php

use Illuminate\Database\Seeder;
use App\Modules\Timezone\Models\Timezone;

class TimezoneSeeder extends Seeder
{
    public function run()
    {
        $timezones = Timezone::count();
        if (empty($timezones)) {
            $timezones = [
                ['timezone_name' => 'Europe/London'],
                ['timezone_name' => 'Europe/Berlin'],
                ['timezone_name' => 'Europe/Kiev'],
                ['timezone_name' => 'Asia/Dubai'],
                ['timezone_name' => 'Asia/Singapore'],
                ['timezone_name' => 'America/New_York'],
                ['timezone_name' => 'America/Toronto'],
                ['timezone_name' => 'America/Chicago'],
                ['timezone_name' => 'America/Los_Angeles'],
                ['timezone_name' => 'Asia/Tokyo']
            ];
            Timezone::insert($timezones);
        }
    }
}
