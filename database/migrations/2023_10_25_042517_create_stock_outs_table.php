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
        Schema::create('stock_out', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('furniture_id');
            $table->string('code');
            $table->string('furniture_code');
            $table->string('furniture_name');
            $table->unsignedFloat('furniture_price');
            $table->bigInteger('amount');
            $table->bigInteger('initial_stock');
            $table->bigInteger('final_stock');
            $table->unsignedFloat('total');

            $table->foreign('buyer_id')->references('id')->on('buyer')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_out');
    }
};
