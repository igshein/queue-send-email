<?php

namespace App\Modules\MessageSchedule\Models;

use Illuminate\Database\Eloquent\Model;

class LogsSendMessage extends Model
{
    public $timestamps = false;
    protected $table = 'logs_send_message';
    protected $fillable = [
        'logs_send_message_id', 'message_id', 'customer_id', 'message', 'date_send'
    ];
}
