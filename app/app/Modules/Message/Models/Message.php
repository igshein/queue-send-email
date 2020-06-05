<?php

namespace App\Modules\Message\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $table = 'message';
    protected $fillable = [
        'message_id', 'message_content'
    ];
}
