<?php

namespace App\Modules\MessageSchedule\Models;

use Illuminate\Database\Eloquent\Model;

class MessageSchedule extends Model
{
    public $timestamps = false;
    protected $table = 'message_schedule';
    protected $fillable = [
        'message_schedule_id', 'message_id', 'message_schedule_time'
    ];
}
