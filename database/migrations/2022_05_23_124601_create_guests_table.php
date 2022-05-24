<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reg_number')->nullable();
            $table->string('name', 25)->nullable();
            $table->string('birth_place', 25)->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('major', 25)->nullable();
            $table->string('study_program', 25)->nullable();
            $table->string('class', 25)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
