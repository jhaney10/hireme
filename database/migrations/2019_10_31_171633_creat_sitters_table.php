<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatSittersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sitters'))
        Schema::create('sitters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('iduser');
            $table->string('aboutme', 200);
            $table->string('photo', 200);
            $table->enum('gender', ['female','male']);
            $table->bigInteger('sit_exper');
            $table->date('dob');
            $table->enum('marital_stat', ['single','married','n/a']);
            $table->enum('availability', ['available','not available']);
            $table->bigInteger('rate1');
            $table->bigInteger('rate2');
            $table->bigInteger('rate3');
            $table->enum('highedu', ['SSCE','Primary','Tertiary','Others']);
            $table->string('highedu_others', 100);
            $table->enum('appr_status', ['approved','not approved','awaiting']);
            $table->enum('ref_status', ['approved','not approved','awaiting']);
            $table->enum('med_status', ['approved','not approved','awaiting']);
            $table->enum('med_avail', ['available','not available']);
            $table->enum('hepb', ['checked','not checked']);
            $table->enum('hiv', ['checked','not checked']);
            $table->string('bank', 100);
            $table->string('bank_acct', 100);
            $table->bigInteger('banknum');
            $table->string('ref_fname', 100);
            $table->string('ref_lname', 100);
            $table->string('ref_phone', 100);
            $table->string('ref_address', 200);
            $table->bigInteger('ref_city');
            $table->string('ref_state');
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
        Schema::dropIfExists('sitters');
    }
}
