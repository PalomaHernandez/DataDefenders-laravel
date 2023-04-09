<?php

namespace Database\Factories;

use App\Models\DocumentationFile;
use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentationFileFactory extends Factory {

	protected $model = DocumentationFile::class;

	public function definition():array{
		return [
			'path' => fake()->filePath(),
			'request_id' => Request::inRandomOrder()->first('id')->id,
		];
	}

}
