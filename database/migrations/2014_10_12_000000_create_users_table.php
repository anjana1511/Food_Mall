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
            $table->string('username');
            $table->text('image')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('role')->comment('0=cashear,1=admin,2=user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('phone');
            $table->string('address');
            $table->string('gender');
            $table->date('dob');
            $table->date('join_date');
            $table->string('job_type');
            $table->string('city');
            $table->bigInteger('age');
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
