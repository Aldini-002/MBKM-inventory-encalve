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
        Schema::create('furniture_stock_out', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('furniture_id');
            $table->unsignedBigInteger('stock_out_id');
            $table->unsignedBigInteger('qty');

            $table->foreign('furniture_id')->references('id')->on('furniture')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('stock_out_id')->references('id')->on('stock_out')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_stock_out');
    }
};
