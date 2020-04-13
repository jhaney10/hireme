<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditIddetails extends Migration
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
        Schema::table('iddetails', function(Blueprint $table) {
            $table->string('means', 100)->nullable()->change();
            $table->string('idnum', 100)->nullable()->change();
            $table->date('idexpire')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iddetails', function(Blueprint $table) {
            $table->string('means', 100)->nullable(false)->change();
            $table->string('idnum', 100)->nullable(false)->change();
            $table->date('idexpire')->nullable(false)->change();
        });
    }
}
