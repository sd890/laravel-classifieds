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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('total_price')->default(0);
            $table->string('transaction_id')->nullable();
            $table->integer('code')->nullable();//کد تحویل
            $table->string('status')->default(\App\Enums\paymentStatus::Draf);
            $table->string('gateway')->default('zarinpal'); // درگاه پرداخت
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
