<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {

	protected $model = User::class;

	public function definition():array{
		return [
			'first_name'        => fake()->firstName(),
			'middle_name'       => fake()->firstName(),
			'last_name'         => fake()->lastName(),
			'email'             => fake()->unique()->safeEmail(),
			'email_verified_at' => now(),
			'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
			'remember_token'    => Str::random(10),
			'phone'             => fake()->phoneNumber(),
			'address_line_1'    => fake()->streetAddress(),
			'address_line_2'    => null,
			'city'              => 'Charlotte',
			'region'            => 'North Carolina',
			'country'           => 'United States of America',
			'postal_code'       => '28201',
			'id_card'           => fake()->numerify('########'),
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified():static{
		return $this->state(fn(array $attributes) => [
			'email_verified_at' => null,
		]);
	}

}
