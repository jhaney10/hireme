<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditSitters extends Migration
{
    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sitters', function(Blueprint $table) {
            $table->string('aboutme', 200)->nullable()->change();
            $table->string('photo', 200)->nullable()->change();
            $table->string('bank', 100)->nullable()->change();
            $table->string('bank_acct', 100)->nullable()->change();
            $table->bigInteger('banknum')->nullable()->change();
            $table->string('ref_fname', 100)->nullable()->change();
            $table->string('ref_lname', 100)->nullable()->change();
            $table->string('ref_phone', 100)->nullable()->change();
            $table->string('ref_address', 200)->nullable()->change();
            $table->bigInteger('ref_city')->nullable()->change();
            $table->string('ref_state')->nullable()->change();
            $table->string('highedu_others', 100)->nullable()->change();
            $table->date('dob')->nullable()->change();
            $table->decimal('rate1', 10, 2)->nullable()->change();
            $table->decimal('rate2',10, 2)->nullable()->change();
            $table->decimal('rate3', 10, 2)->nullable()->change();
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sitters', function(Blueprint $table) {
            $table->string('aboutme', 200)->nullable(false)->change();
            $table->string('photo', 200)->nullable(false)->change();
            $table->string('bank', 100)->nullable(false)->change();
            $table->string('bank_acct', 100)->nullable(false)->change();
            $table->bigInteger('banknum')->nullable(false)->change();
            $table->string('ref_fname', 100)->nullable(false)->change();
            $table->string('ref_lname', 100)->nullable(false)->change();
            $table->string('ref_phone', 100)->nullable(false)->change();
            $table->string('ref_address', 200)->nullable(false)->change();
            $table->bigInteger('ref_city')->nullable(false)->change();
            $table->string('ref_state')->nullable(false)->change();
            $table->string('highedu_others', 100)->nullable(false)->change();
            $table->date('dob')->nullable(false)->change();
            $table->decimal('rate1', 10, 2)->nullable(false)->change();
            $table->decimal('rate2',10, 2)->nullable(false)->change();
            $table->decimal('rate3', 10, 2)->nullable(false)->change();
        
        });
    }
}
