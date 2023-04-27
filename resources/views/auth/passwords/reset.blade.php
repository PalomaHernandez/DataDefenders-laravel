@extends('layouts.app')

@section('title')
	Password reset
@endsection

@section('content')
	<form action="{{ route('password.change') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
		<x-slot:title>
            Password reset
			</x-slot:title>
			<x-slot:description></x-slot:description>
			<x-slot:buttons></x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<input type="hidden" id="email" name="email" value="{{ request('email') }}">
				<div class="labeled-input">
					<label>Email</label>
					<p class="fake-disabled">{{ request('email') }}</p>
				</div>
				<div class="labeled-input">
					<label for="password">New Password</label>
					<input type="password" id="password" name="password">
				</div>
				<div class="labeled-input">
					<label for="password_confirmation">Confirm password</label>
					<input type="password" id="password_confirmation" name="password_confirmation">
				</div>
				<button type="submit" class="btn btn-primary">
					Reset password
				</button>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection