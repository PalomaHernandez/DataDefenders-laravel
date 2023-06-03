<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepository {

	public function authenticated():User;

	public function findById(int $id):User;

	public function create():User;

	public function update(int $id):User;

	public function destroy(int $id):?bool;

}