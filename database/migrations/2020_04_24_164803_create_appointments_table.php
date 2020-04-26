<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->id();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('specialty_id')->nullable();
            $table->enum('state', ['scheduled', 'ongoing', 'complete'])->default('scheduled');
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->unique(['patient_id', 'date', 'time']);
            $table->unique(['doctor_id', 'date', 'time']);
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
            $table->foreign('specialty_id')->references('id')->on('specialties')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
