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
            $table->unsignedBigInteger('patient_code');
            $table->string('doctor_code')->nullable();
            $table->date('date');
            $table->enum('time', ['13:00', '13:40', '14:20', '15:00', '15:40', '16:20'])->default('13:40');
            $table->enum('state', ['scheduled', 'ongoing', 'complete'])->default('scheduled');
            $table->float('patient_weight')->nullable();
            $table->text('description')->nullable();
            $table->text('prescription')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['patient_code', 'date', 'time']);
            $table->unique(['doctor_code', 'date', 'time']);
            $table->unique(['patient_code', 'doctor_code', 'date', 'time']);

            $table->foreign('patient_code')->references('patient_code')->on('patients')->cascadeOnDelete();
            $table->foreign('doctor_code')->references('certification_code')->on('doctors')->cascadeOnDelete();
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
