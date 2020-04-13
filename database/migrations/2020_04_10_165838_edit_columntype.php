<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditColumntype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->bigInteger('idcity')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('photo')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('address')->nullable(false)->change();
            $table->bigInteger('idcity')->nullable(false)->change();
            $table->string('state')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('photo')->nullable(false)->change();
        });
    }
}
