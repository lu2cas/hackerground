<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHackerspacesPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hackerspaces_partners', function (Blueprint $table) {
            $table->unsignedBigInteger('hackerspace_id');
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('created_by');
            $table->dateTime('created_at');

            $table->foreign('hackerspace_id')->references('id')->on('hackerspaces');
            $table->foreign('partner_id')->references('id')->on('hackerspaces');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hackerspaces_partners');
    }
}
