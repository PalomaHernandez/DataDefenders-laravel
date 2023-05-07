<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up():void{
		Schema::create('documentation_files', function (Blueprint $table){
			$table->id();
			$table->mediumText('path');
			$table->foreignId('request_id')->references('id')->on('requests')->restrictOnDelete()->cascadeOnUpdate();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down():void{
		Schema::dropIfExists('documentation_files');
	}

};
