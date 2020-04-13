<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookedsittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('bookedsitters'))
        Schema::create('bookedsitters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('idbookings');
            $table->foreign('idbookings')
                  ->references('id')->on('bookings')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->bigInteger('idsitter');
            $table->string('sitter_response', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookedsitters');
    }
}
