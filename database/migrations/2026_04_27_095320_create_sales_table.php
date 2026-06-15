<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->unique();

            $table->string('customer_name');
            $table->string('customer_phone')->nullable();

            $table->date('sale_date');

            $table->decimal('total_amount', 14, 2)->default(0);
            $table->decimal('total_cost', 14, 2)->default(0);
            $table->decimal('profit', 14, 2)->default(0);

            $table->enum('status', [
                'diproses',
                'dikemas',
                'dikirim',
                'selesai',
                'dibatalkan',
                'return'
            ])->default('diproses');

            $table->text('note')->nullable();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};