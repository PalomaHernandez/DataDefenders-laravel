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
        Schema::create('exchange_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->foreignId('university_id')->references('id')->on('universities');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->tinyInteger('visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_offers');
    }
};
