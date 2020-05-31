<?php

namespace App\Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $table = 'customer';
    protected $fillable = [
        'customer_id', 'name', 'email', 'password', 'timezone', 'date_create'
    ];
}
