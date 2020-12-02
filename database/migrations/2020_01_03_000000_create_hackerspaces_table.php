<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHackerspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hackerspaces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('geolocation')->nullable();
            $table->string('logo_path')->nullable();
            $table->date('founded_on');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'PLANNED']);
            $table->string('website')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

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
        Schema::dropIfExists('hackerspaces');
    }
}
