@extends('layouts.app')

@section('title')
    My account
@endsection

@section('content')
    <form action="{{ route('users.update') }}" method="post" class="flex-grow h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>My account</x-slot:title>
			<x-slot:description>Edit your personal information.</x-slot:description>
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
						<label for="first_name">First name</label>
						<input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="middle_name">Middle name</label>
						<input type="text" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
					</div>
					<div class="labeled-input flex-grow">
						<label for="last_name">Lastname</label>
						<input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
					</div>
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection