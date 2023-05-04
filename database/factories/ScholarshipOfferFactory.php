<?php

namespace Database\Factories;

use App\Models\ScholarshipOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScholarshipOfferFactory extends Factory {

	protected $model = ScholarshipOffer::class;

	public function definition():array{
		return [
			'title' => fake()->text(50),
			'description' => fake()->realText(4000),
			'requirements' => fake()->realText(4000),
			'starts_at' => now()->subWeek()->setSecond(0),
			'ends_at' => now()->addWeek()->setSecond(0),
			'public' => rand(0, 1)
		];
	}

}
