<?php

namespace Database\Factories;

use App\Models\ExchangeOffer;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExchangeOfferFactory extends Factory {

	protected $model = ExchangeOffer::class;

	public function definition():array{
		return [
			'title' => fake()->text(50),
			'description' => fake()->realText(4000),
			'requirements' => fake()->realText(4000),
			'university_id' => University::inRandomOrder()->first('id')->id,
			'starts_at' => now()->subWeek(),
			'ends_at' => now()->addWeek(),
			'visible' => rand(0, 1)
		];
	}

}
