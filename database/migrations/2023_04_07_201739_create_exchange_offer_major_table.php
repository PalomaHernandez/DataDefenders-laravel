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
        Schema::create('exchange_offer_major', function (Blueprint $table) {
            $table->foreignId('exchange_offer_id')->references('id')->on('exchange_offers')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('major_id')->references('id')->on('majors')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_offer_major');
    }
};
