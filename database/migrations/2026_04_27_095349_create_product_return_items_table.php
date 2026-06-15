<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_return_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_return_id')
                ->constrained('product_returns')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->nullOnDelete();

            $table->string('product_name');

            $table->integer('qty')->default(1);

            $table->decimal('selling_price', 14, 2)->default(0);
            $table->decimal('subtotal', 14, 2)->default(0);

            $table->boolean('back_to_stock')->default(false);

            $table->text('reason')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_return_items');
    }
};