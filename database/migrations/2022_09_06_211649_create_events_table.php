<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id',15);
            $table->integer('event_status');
            $table->unsignedInteger('userId');
            $table->foreign('userId') ->references('userId')->on('users')->onDelete('cascade');
            $table->string('event_image')->nullable();
            $table->string('event_name')->nullable();
            $table->string('event_description')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->string('category')->nullable();
            $table->string('event_organizer')->nullable();
            $table->string('event_venue')->nullable();
            $table->string('event_address')->nullable();
            $table->double('address_latitude')->nullable();
            $table->double('address_longitude')->nullable();
            $table->integer('contact_phone')->nullable();
            $table->string('redirectUrl')->nullable();
            $table->integer('event_entrance_fee')->nullable();
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
        Schema::dropIfExists('events');
    }
};
