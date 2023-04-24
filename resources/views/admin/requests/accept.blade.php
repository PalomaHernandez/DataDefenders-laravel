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
				<button type="submit" class="btn bg-green-700 text-white">
					<i class="fa-solid fa-check"></i>
					Accept
				</button>
			</x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col items-start gap-3 p-6">
			<p class="font-bold">Are you sure? This will accept the application.</p>
		</div>
	</form>
@endsection