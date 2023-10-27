<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('furniture_stock_ins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_in_id');
            $table->unsignedBigInteger('furniture_id');
            $table->string('furniture_code');
            $table->string('furniture_name');
            $table->unsignedFloat('furniture_price');
            $table->bigInteger('amount');
            $table->bigInteger('initial_stock');
            $table->bigInteger('final_stock');

            $table->foreign('stock_in_id')->references('id')->on('stock_in')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_stock_ins');
    }
};
