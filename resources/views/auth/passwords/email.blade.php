@extends('layouts.app')

@section('title')
	Account recovery
@endsection

@section('content')
	<form action="{{ route('reset.link.send') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
			<x-slot:title>
					Account recovery
			</x-slot:title>
			<x-slot:description>
				Enter your user account's verified e-mail address and we will send you a password reset link.
			</x-slot:description>
			<x-slot:buttons></x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="labeled-input">
					<label for="email">E-mail address</label>
					<input type="email" id="email" name="email" value="{{ old('email') }}">
				</div>
				<div class="flex items-center gap-3">
					<a href="{{ route('login') }}" class="btn btn-outline-primary">
						<i class="fa-solid fa-chevron-left"></i>
						Back to login
					</a>
					<button type="submit" class="btn btn-primary">
						<i class="fa-solid fa-envelope"></i>
						Send recovery e-mail
					</button>
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection