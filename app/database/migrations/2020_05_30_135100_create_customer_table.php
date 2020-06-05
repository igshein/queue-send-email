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
            $table->string('customer_email')->unique();;
            $table->unsignedInteger('timezone_id');
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table->foreign('timezone_id')->references('timezone_id')->on('timezone')->onDelete('cascade');
            $table->index('timezone_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
