<?php

namespace App\Modules\Timezone\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    public $timestamps = false;
    protected $table = 'timezone';
    protected $fillable = [
        'timezone_id', 'timezone_name'
    ];
}
