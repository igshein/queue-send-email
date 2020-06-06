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
                ['timezone_name' => 'Europe/Paris'],
                ['timezone_name' => 'Europe/Kiev'],
                ['timezone_name' => 'Europe/Dublin'],
                ['timezone_name' => 'Asia/Dubai'],
                ['timezone_name' => 'Asia/Singapore'],
                ['timezone_name' => 'America/New_York'],
                ['timezone_name' => 'America/Toronto'],
                ['timezone_name' => 'America/Chicago'],
                ['timezone_name' => 'America/Los_Angeles'],
                ['timezone_name' => 'America/Denver'],
                ['timezone_name' => 'America/Detroit'],
                ['timezone_name' => 'America/Mexico_City'],
                ['timezone_name' => 'Asia/Tokyo'],
                ['timezone_name' => 'Asia/Damascus'],
                ['timezone_name' => 'Asia/Shanghai'],
                ['timezone_name' => 'Asia/Kuala_Lumpur'],
                ['timezone_name' => 'Asia/Karachi'],
                ['timezone_name' => 'Australia/Sydney']
            ];
            Timezone::insert($timezones);
        }
    }
}
