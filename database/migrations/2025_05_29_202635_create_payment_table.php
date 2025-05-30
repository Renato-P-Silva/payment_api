<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_client', 120);
            $table->string('cpf', 11);
            $table->string('description', 255)->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'paid', 'expired', 'failed']);
            $table->enum('method_payment', ['pix', 'boleto', 'bank_transfer']);
            $table->timestamp('paid_at')->useCurrent();
            $table->foreignId('merchant_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
