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
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->unsignedBigInteger('last_record_m1')->nullable();
            $table->foreign('last_record_m1')->references('id')->on('crypto_currency_historicals');
            $table->unsignedBigInteger('last_record_m5')->nullable();
            $table->foreign('last_record_m5')->references('id')->on('crypto_currency_historicals');

            $table->unsignedBigInteger('last_record_m15')->nullable();
            $table->foreign('last_record_m15')->references('id')->on('crypto_currency_historicals');

            $table->unsignedBigInteger('last_record_m30')->nullable();
            $table->foreign('last_record_m30')->references('id')->on('crypto_currency_historicals');

            $table->unsignedBigInteger('last_record_h1')->nullable();
            $table->foreign('last_record_h1')->references('id')->on('crypto_currency_historicals');

            $table->unsignedBigInteger('last_record_h4')->nullable();
            $table->foreign('last_record_h4')->references('id')->on('crypto_currency_historicals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crypto_currencies', function (Blueprint $table) {
            $table->dropForeign(['last_record_m1']);
            $table->dropForeign(['last_record_m5']);
            $table->dropForeign(['last_record_m15']);
            $table->dropForeign(['last_record_m30']);
            $table->dropForeign(['last_record_h1']);
            $table->dropForeign(['last_record_h4']);

            $table->dropColumn(['last_record_m1', 'last_record_m5', 'last_record_m15', 'last_record_m30', 'last_record_h1', 'last_record_h4']);
        });
    }
};
