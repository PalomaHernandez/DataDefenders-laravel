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
				Enter your user account's verified email address and we will send you a password reset link.
			</x-slot:description>
			<x-slot:buttons></x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6">
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
			<div class="labeled-input">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" value="{{ old('email') }}">
			</div>
			<button type="submit" class="btn bg-sky-700 text-white w-max">
					Send recovery email
			</button>
		</div>
	</form>
@endsection