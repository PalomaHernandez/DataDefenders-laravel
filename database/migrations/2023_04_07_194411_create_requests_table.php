<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up():void{
		Schema::create('requests', function (Blueprint $table){
			$table->id();
			$table->unsignedBigInteger('number')->unique();
			$table->foreignId('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();
			$table->unsignedBigInteger('offer_id');
			$table->string('offer_type');
			$table->enum('status', ['pending', 'documentation', 'accepted', 'rejected']);
			$table->foreignId('major_id')->nullable()->references('id')->on('majors')->restrictOnDelete()->cascadeOnUpdate();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down():void{
		Schema::dropIfExists('requests');
	}

};
