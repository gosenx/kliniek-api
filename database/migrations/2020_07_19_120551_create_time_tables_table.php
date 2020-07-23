<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_code');
            $table->date('date');
            $table->enum('time', ['13:00', '13:40', '14:20', '15:00', '15:40', '16:20'])->default('13:40');

            $table->unique(['doctor_code', 'date', 'time']);
            $table->foreign('doctor_code')->references('certification_code')->on('doctors')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }
}
