<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hackerspace_id');
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['ONLINE', 'IN_PERSON']);
            $table->string('url')->nullable();
            // @todo Change "activity" to a foreign key to an external table
            $table->enum('activity', ['MEETING', 'WORKSHOP', 'TALK', 'HACKATON', 'CTF', 'CODING_DOJO', 'OTHER']);
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->text('summary')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('hackerspace_id')->references('id')->on('hackerspaces');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
