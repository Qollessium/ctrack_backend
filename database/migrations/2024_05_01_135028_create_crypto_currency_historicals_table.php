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
        Schema::create('crypto_currency_historicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crypto_currency_id')->constrained()->onDelete('cascade');
            $table->double('price');
            $table->string('interval');
            $table->datetime('date');
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_currency_historicals');
    }
};
