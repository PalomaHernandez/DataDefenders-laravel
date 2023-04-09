<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

class MajorFactory extends Factory {

	protected $model = Major::class;

	public function definition():array{
		return [
			'name' => fake()->text(50),
			'department_id' => Department::inRandomOrder()->first('id')->id,
		];
	}

}
