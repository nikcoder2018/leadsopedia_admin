<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_data', function (Blueprint $table) {
            $table->id();
            $table->string('email', 64);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('dataset');
            $table->string('target');
            $table->enum('status', ['pending', 'on progress', 'completed', 'denied']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_data');
    }
}
