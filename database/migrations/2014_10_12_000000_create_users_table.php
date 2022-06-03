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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone')->unique();
            $table->string('city')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('verify')->default(0);
            $table->tinyInteger('role')->default(\App\Enums\RoleEnum::CUSTOMER()->value);
            $table->tinyInteger('ban')->default(0);
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
