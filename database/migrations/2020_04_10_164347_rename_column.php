<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->renameColumn('fname', 'user_fname');
            $table->renameColumn('lname', 'user_lname');
            $table->string('usertype',100);
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
            $table->renameColumn('user_fname', 'fname');
            $table->renameColumn('user_lname', 'lname');
            $table->dropColumn('usertype');
        });
    }
}
