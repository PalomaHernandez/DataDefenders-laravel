@extends('layouts.app')

@section('title')
	Require documentation from {{ $request->user->fullName }}
@endsection

@section('content')
	<form action="{{ route('requests.document', $request) }}" method="post" class="flex-grow h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('requests.edit', $request) }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Require documentation from {{ $request->user->fullName }}
			</x-slot:title>
			<x-slot:description>Require documentation for the {{ $request->offer->displayName }} application.</x-slot:description>
			<x-slot:buttons>
				@can('require.request.documentation')
					<button type="submit" class="btn bg-purple-700 text-white">
						<i class="fa-solid fa-file-lines"></i>
						Require documentation
					</button>
				@endcan
			</x-slot:buttons>
		</x-header>
		<x-body>
			<x-slot:content>
				<p class="font-bold">Are you sure? This will require documentation for the application.</p>
				<div class="labeled-input">
					<label for="comments">Add your comments.</label>
					<textarea id="comments" name="comments" required></textarea>
				</div>
			</x-slot:content>
		</x-body>
	</form>
@endsection