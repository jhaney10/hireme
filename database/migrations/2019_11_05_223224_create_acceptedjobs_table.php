<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptedjobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('acceptedjobs'))
        Schema::create('acceptedjobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('idbookings');
            $table->foreign('idbookings')
                  ->references('id')->on('bookings')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->bigInteger('idsitter');
            $table->bigInteger('idparent');
            $table->string('status', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acceptedjobs');
    }
}
