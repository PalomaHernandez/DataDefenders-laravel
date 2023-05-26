<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory {

	protected $model = Comment::class;

	public function definition():array{
		return [
			'text' => fake()->text(10000),
			'application_id' => Application::inRandomOrder()->first('id')->id,
			'user_id' => User::inRandomOrder()->first('id')->id,
		];
	}

}
