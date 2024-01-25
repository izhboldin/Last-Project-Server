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
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('option_id');

            $table->index('product_id', 'product_option_product_idx');
            $table->index('option_id', 'product_option_option_idx');

            $table->foreign('product_id', 'product_option_product_fk')->on('products')->references('id');
            $table->foreign('option_id', 'product_option_option_fk')->on('options')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option');
    }
};
