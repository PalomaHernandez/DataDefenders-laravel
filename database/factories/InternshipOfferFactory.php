<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\InternshipOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternshipOfferFactory extends Factory {

	protected $model = InternshipOffer::class;

	public function definition():array{
		return [
			'title' => fake()->text(50),
			'description' => fake()->realText(4000),
			'requirements' => fake()->realText(4000),
			'company_id' => Company::inRandomOrder()->first('id')->id,
			'starts_at' => now()->subWeek(),
			'ends_at' => now()->addWeek(),
			'visible' => rand(0, 1)
		];
	}

}
