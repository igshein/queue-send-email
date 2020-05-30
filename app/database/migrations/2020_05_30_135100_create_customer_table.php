<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    protected $table = 'customer';
    protected $primaryKey = false;
    protected $timestamps = false;

    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('timezone');
            $table->timestamp('date_create');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
