<?php
namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository {

	public function authenticated():User{
		return User::findOrFail(auth()->id());
	}

	public function findById(int $id):User{
		return User::findOrFail($id);
	}

	public function create():User{
		$validated = $this->validate();
		request()->validate([
			'email' => ['email', 'unique:users', 'max:255'],
			'password' => ['string', 'confirmed']
		]);
		$validated['email'] = request('email');
		$validated['password'] = Hash::make(request('password'));
		return User::create($validated);
	}

	private function validate():array{
		return request()->validate([
			'first_name' => ['string', 'required', 'max:255'],
			'middle_name' => ['string', 'nullable', 'max:255'],
			'last_name' => ['string', 'required', 'max:255'],
			'phone' => ['string', 'required', 'max:20'],
			'address_line_1' => ['string', 'required', 'max:255'],
			'address_line_2' => ['string', 'nullable', 'max:255'],
			'city' => ['string', 'required', 'max:255'],
			'region' => ['string', 'required', 'max:255'],
			'country' => ['string', 'required', 'max:255'],
			'postal_code' => ['string', 'required', 'max:10'],
			'id_card' => ['string', 'required', 'max:20'],
		]);
	}

	public function update(int $id):User{
		$user = $this->findById($id);
		$user->update($this->validate());
		return $user->fresh();
	}

	public function destroy(int $id):?bool{
		return $this->findById($id)->delete();
	}

}