<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('bi', 11)->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('password'));
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->string('profile_type')->nullable();
            $table->unsignedInteger('profile_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
