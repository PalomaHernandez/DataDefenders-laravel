<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up():void{
		Schema::create('users', function (Blueprint $table){
			$table->uuid()->unique();
			$table->bigIncrements('id')->unique();
			$table->string('first_name');
			$table->string('middle_name')->nullable();
			$table->string('last_name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->string('phone', 20);
			$table->string('address_line_1');
			$table->string('address_line_2');
			$table->string('city');
			$table->string('region');
			$table->string('country');
			$table->string('postal_code', 10);
			$table->string('id_card', 20);
			$table->timestamps();
		});
		Schema::table('users', function (Blueprint $table){
			DB::statement('ALTER TABLE `'.DB::getDatabaseName().'`.`'.$table->getTable().'` DROP PRIMARY KEY, ADD PRIMARY KEY (`uuid`);');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down():void{
		Schema::dropIfExists('users');
	}

};