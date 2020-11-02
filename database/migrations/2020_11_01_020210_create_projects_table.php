<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hackerspace_id');
            $table->string('title');
            $table->text('description');
            $table->date('start_date');
            $table->enum('status', ['ONGOING', 'PAUSED', 'FINISHED']);
            // @todo Change "category" to a foreign key to an external table
            $table->enum('category', ['SOFTWARE', 'HARDWARE', 'SOCIAL']);
            $table->string('repository')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
