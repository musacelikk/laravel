<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('keywords')->nullable();
            $table->text('description');
            $table->string('image');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->text('detail')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity')->default(0);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default('active');
            $table->string('slug')->unique();
            $table->decimal('compare_price', 10, 2)->nullable();
            $table->string('brand')->default('E-SHOP');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedInteger('review_count')->default(0);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_deal')->default(false);
            $table->json('sizes')->nullable();
            $table->json('colors')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
