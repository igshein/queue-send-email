<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(MessageScheduleSeeder::class);
    }
}
