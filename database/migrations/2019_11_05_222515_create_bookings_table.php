<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('bookings'))
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('idsitter');
            $table->bigInteger('idparent');
            $table->timestamp('booking_date')->nullable();
            $table->string('chore_address',200);
            $table->bigInteger('idcity');
            $table->string('state',100);
            $table->string('phone');
            $table->string('landmark',200);
            $table->string('urgency',100);
            $table->date('chore_date');
            $table->time('timestart');
            $table->bigInteger('num_hours');
            $table->string('num_child');
            $table->string('instructions',200);
            $table->string('bookingstatus');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
