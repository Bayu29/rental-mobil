<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('color',255);
            $table->string('police_number', 255);
            $table->string('cc', 255);
            $table->integer('capacity');
            $table->string('year')->nullable();
            $table->enum('type', ['manual', 'matic']);
            $table->enum('status', ['available', 'non_avalaible', 'repaired']);
            $table->integer('fee')->default(0);
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
        Schema::dropIfExists('cars');
    }
};
