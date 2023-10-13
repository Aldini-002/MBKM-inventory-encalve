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
        Schema::create('stock_in', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('furniture_id');
            $table->string('code');
            $table->string('suplier');
            $table->string('name');
            $table->unsignedFloat('price');
            $table->bigInteger('stock_in');
            $table->bigInteger('initial_stock');
            $table->bigInteger('final_stock');

            $table->foreign('furniture_id')->references('id')->on('furniture')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_in');
    }
};
