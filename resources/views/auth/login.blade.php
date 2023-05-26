@extends('layouts.app')

@section('title')
	Log in
@endsection

@section('content')
	<form action="{{ route('login') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
		<x-slot:title>
				Log in
			</x-slot:title>
			<x-slot:description></x-slot:description>
			<x-slot:buttons></x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="labeled-input">
					<label for="email">E-mail address</label>
					<input type="email" id="email" name="email" value="{{ old('email') }}">
				</div>
				<div class="labeled-input">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="{{ old('password') }}">
				</div>
				<div class="flex items-center gap-3">
					<a href="{{ route('account.recovery') }}" class="btn btn-outline-primary">
						<i class="fa-solid fa-key"></i>
						Forgot your password?
					</a>
					<button type="submit" class="btn btn-primary">
						<i class="fa-solid fa-sign-in"></i>
						Log in
					</button>
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection