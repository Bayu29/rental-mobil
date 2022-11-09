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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->text('customer_destination');
            $table->string('customer_id_card_number');
            $table->string('customer_sim_card_number');
            $table->foreignId('car_id');
            $table->foreignId('driver_id');
            $table->foreignId('user_id');
            $table->timestamp('pick_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->enum('car_status', ['unpickup','returned', 'unreturn'])->default('unpickup');
            $table->enum('status', ['unpaid', 'paid', 'canceled'])->default('unpaid');
            $table->enum('approved1', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('approved2', ['pending', 'approved', 'rejected'])->default('pending');
            $table->integer('car_fee')->default(0);
            $table->integer('driver_fee')->default(0);
            $table->integer('late_charge')->default(0);
            $table->integer('total_charge')->default(0);
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
