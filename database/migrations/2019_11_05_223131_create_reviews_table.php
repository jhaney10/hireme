<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('idbookings');
            $table->foreign('idbookings')
                  ->references('id')->on('bookings')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->bigInteger('idsitter');
            $table->bigInteger('idparent');
            $table->bigInteger('ratings');
            $table->string('review_title',100);
            $table->string('review','200');
            $table->timestamp('date_review')->nullable();;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
