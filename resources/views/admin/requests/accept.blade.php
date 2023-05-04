@extends('layouts.app')

@section('title')
	Accept application by {{ $request->user->fullName }}
@endsection

@section('content')
	<form action="{{ route('requests.accept', $request) }}" method="post" class="flex-grow h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('requests.edit', $request) }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Accept application by {{ $request->user->fullName }}
			</x-slot:title>
			<x-slot:description>Accept the {{ $request->offer->displayName }} application.</x-slot:description>
			<x-slot:buttons>
				@can('accept.requests')
					<button type="submit" class="btn bg-green-700 text-white">
						<i class="fa-solid fa-check"></i>
						Accept
					</button>
				@endcan
			</x-slot:buttons>
		</x-header>
		<x-body>
			<x-slot:content>
				<p class="font-bold">Are you sure? This will accept the application.</p>
				<div class="labeled-input">
					<label for="comments">Add your comments, if any.</label>
					<textarea id="comments" name="comments"></textarea>
				</div>
			</x-slot:content>
		</x-body>
	</form>
@endsection