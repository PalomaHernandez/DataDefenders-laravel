<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory {

	protected $model = University::class;

	public function definition():array{
		return [
			'name' => fake()->text(50),
			'country' => fake()->country(),
		];
	}

}
