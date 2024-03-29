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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->bigInteger('category_id');
            $table->bigInteger('brand_id');
            $table->bigInteger('supplier_id');
            $table->integer('qty');
            $table->integer('buy_price');
            $table->integer('sale_price');
            $table->integer('discount_price');
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->integer('rating')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
