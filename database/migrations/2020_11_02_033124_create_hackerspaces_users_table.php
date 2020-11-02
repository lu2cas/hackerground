<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHackerspacesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hackerspaces_users', function (Blueprint $table) {
            $table->unsignedBigInteger('hackerspace_id');
            $table->unsignedBigInteger('user_id');
            // @todo Change "profile" to a foreign key to an external table
            $table->enum('profile', ['MEMBER', 'ADMIN']);
            $table->dateTime('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->foreign('hackerspace_id')->references('id')->on('hackerspaces');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hackerspaces_users');
    }
}
