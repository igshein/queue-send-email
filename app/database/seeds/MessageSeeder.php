<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

//create table message
//(
//    message_id  bigint unsigned auto_increment
//        primary key,
//    customer_id bigint unsigned not null,
//    message     text            not null,
//    date_create datetime        not null,
//    constraint message_customer_id_foreign
//        foreign key (customer_id) references customer (customer_id)
//            on delete cascade
//)

class MessageSeeder extends Seeder
{
//    public $table = 'message';
//
//    public function run()
//    {
//        $countMessages = 10;
//        if (empty(DB::table($this->table)->where('customer_id', $countCustomers)->first())) {
//            for ($i = 0; $i < $countCustomers; $i++) {
//                DB::table($this->table)->insert([
//                    'name' => Str::random(12),
//                    'email' => Str::random(24) . '@gmail.com',
//                    'password' => Hash::make('password'),
//                    'date_create' => Carbon::now()->timezone(env('DB_TIME_ZONE'))->format('Y-m-d H:i:s'),
//                    'timezone' => env('DB_TIME_ZONE')
//                ]);
//            }
//        }
//    }
}
