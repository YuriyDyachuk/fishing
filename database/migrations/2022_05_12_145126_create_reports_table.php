<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('blocking')->nullable()->comment('Блокировка на изменение двумя юзерами');
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('region_id')->constrained('regions','id')->cascadeOnDelete();
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
        Schema::dropIfExists('reports');
    }
}
