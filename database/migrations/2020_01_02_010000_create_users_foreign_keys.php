<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * The foreign key to column "address_id" in table "users" must be created after table "addresses" is created
         * due to circular dependency.
         */
        /*Schema::table('users', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });*/
    }
}
