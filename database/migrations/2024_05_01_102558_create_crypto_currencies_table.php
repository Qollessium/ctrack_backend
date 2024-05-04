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
        Schema::create('crypto_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('coincap_id')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('symbol');
            $table->string('status')->default('inactive');
            $table->string('source');
            $table->dateTime('last_record_update_date')->nullable();

            $table->double('last_change_percent_m1')->nullable();
            $table->double('last_change_percent_m5')->nullable();
            $table->double('last_change_percent_m15')->nullable();
            $table->double('last_change_percent_m30')->nullable();
            $table->double('last_change_percent_h1')->nullable();
            $table->double('last_change_percent_h4')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_currencies');
    }
};
