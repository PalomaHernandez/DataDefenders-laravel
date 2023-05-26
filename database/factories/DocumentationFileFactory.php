<?php

namespace Database\Factories;

use App\Models\DocumentationFile;
use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentationFileFactory extends Factory {

	protected $model = DocumentationFile::class;

	public function definition():array{
		return [
			'path' => fake()->filePath(),
			'application_id' => Application::inRandomOrder()->first('id')->id,
		];
	}

}
