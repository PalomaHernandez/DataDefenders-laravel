@extends('layouts.app')

@section('title')
	Password reset
@endsection

@section('content')
<form action="{{ route('change.password') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
		<x-slot:title>
            Password reset
			</x-slot:title>
			<x-slot:description></x-slot:description>
			<x-slot:buttons></x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6">
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
			<div class="labeled-input">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" value="{{ request('email') }}">
                <label for="password">New Password</label>
				<input type="password" id="password" name="password">
                <label for="password_confirmation">Confirm password</label>
				<input type="password" id="password_confirmation" name="password_confirmation">
			</div>
			<button type="submit" class="btn bg-sky-700 text-white w-max">
					Reset password
			</button>
		</div>
	</form>
@endsection