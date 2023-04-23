<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory {

	protected $model = Comment::class;

	public function definition():array{
		return [
			'text' => fake()->text(10000),
			'request_id' => Request::inRandomOrder()->first('id')->id,
		];
	}

}
