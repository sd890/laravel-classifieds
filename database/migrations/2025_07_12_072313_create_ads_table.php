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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->string('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('price')->nullable();
            $table->string('status')->default(\App\Enums\AdStatus::Pending->value);
            $table->boolean('is_featured')->default(false);
            $table->integer('views')->default(0);
            $table->string('price_type')->default(\App\Enums\Price_typeStatus::Negotiable->value);
            $table->date('expired_at')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('contact_number', 20)->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['status', 'is_featured']);
            $table->index('category_id');
            $table->index('city_id');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
