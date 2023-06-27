<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up():void{
		Schema::create('scholarship_offers', function (Blueprint $table){
			$table->id();
			$table->string('title');
			$table->text('description');
			$table->text('requirements');
			$table->timestamp('starts_at');
			$table->timestamp('ends_at');
			$table->tinyInteger('public')->default(0);
			$table->unsignedInteger('fee')->default(1000);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down():void{
		Schema::dropIfExists('scholarship_offers');
	}

};
