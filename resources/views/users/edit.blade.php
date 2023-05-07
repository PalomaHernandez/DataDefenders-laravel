@extends('layouts.app')

@section('title')
    Edit profile
@endsection

@section('content')
    <form action="{{ route('users.update',$user) }}" method="post" class="flex-grow h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('users.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				 Edit profile
			</x-slot:title>
			<x-slot:description>Edit your personal information. Fields marked with * are required.</x-slot:description>
			<x-slot:buttons>
				<button type="submit" class="btn btn-primary">
					<i class="fa-solid fa-check"></i>
					Save changes
				</button>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="flex items-center gap-3">
					<div class="labeled-input flex-grow">
						<label for="first_name" class="required">First name</label>
						<input type="text" id="first_name" name="first_name" value="{{ old('first_name') ? old('first_name') :  $user->first_name }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="middle_name">Middle name</label>
						<input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') ? old('middle_name') : $user->middle_name }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="last_name" class="required">Last name</label>
						<input type="text" id="last_name" name="last_name" value="{{ old('last_name') ? old('last_name') : $user->last_name }}">
					</div>
				</div>
				<div class="labeled-input">
					<label for="email">Email</label>
					<p class="fake-disabled">{{ $user->email }}</p>
				</div>
				<div class="flex items-center gap-3">
					<div class="labeled-input flex-grow">
						<label for="id_card" class="required">ID</label>
						<input type="text" id="id_card" name="id_card" value="{{ old('id_card') ? old('id_card') : $user->id_card }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="phone" class="required">Phone</label>
						<input type="tel" id="phone" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}">
					</div>
				</div>
				<div class="flex items-center gap-3">
					<div class="labeled-input flex-grow">
						<label for="address_line_1" class="required">Address line 1</label>
						<input type="text" id="address_line_1" name="address_line_1" value="{{ old('address_line_1') ? old('address_line_1') : $user->address_line_1 }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="address_line_2">Address line 2</label>
						<input type="text" id="address_line_2" name="address_line_2" value="{{ old('address_line_2') ? old('address_line_2') : $user->address_line_2 }}">
					</div>
				</div>
				<div class="flex items-center gap-3">
					<div class="labeled-input flex-grow">
						<label for="city" class="required">City</label>
						<input type="text" id="city" name="city" value="{{ old('city') ? old('city') : $user->city }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="region" class="required">Region</label>
						<input type="text" id="region" name="region" value="{{ old('region') ? old('region') : $user->region }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="country" class="required">Country</label>
						<input type="text" id="country" name="country" value="{{ old('country') ? old('country') : $user->country }}">
					</div>
				</div>
				<div class="labeled-input">
					<label for="postal_code" class="required">Postal code</label>
					<input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') ? old('postal_code') : $user->postal_code }}">
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection