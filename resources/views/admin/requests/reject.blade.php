@extends('layouts.app')

@section('title')
	Reject application by {{ $request->user->fullName }}
@endsection

@section('content')
	<form action="{{ route('requests.reject', $request) }}" method="post" class="flex-grow h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('requests.edit', $request) }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Reject application by {{ $request->user->fullName }}
			</x-slot:title>
			<x-slot:description>Reject the {{ $request->offer->displayName }} application.</x-slot:description>
			<x-slot:buttons>
				<button type="submit" class="btn bg-red-700 text-white">
					<i class="fa-solid fa-times"></i>
					Reject
				</button>
			</x-slot:buttons>
		</x-header>
		<x-body>
			<x-slot:content>
				<p class="font-bold">Are you sure? This will reject the application.</p>
				<div class="labeled-input">
					<label for="comments">Add your comments.</label>
					<textarea id="comments" name="comments" required></textarea>
				</div>
			</x-slot:content>
		</x-body>
	</form>
@endsection