@extends('layouts.app')

@section('title')
	Application by {{ $request->user->fullName }}
@endsection

@section('content')
	<x-header>
		<x-slot:title>{{ $request->user->fullName }}</x-slot:title>
		<x-slot:description>
			<span class="icon-text">
				<i class="fa-solid fa-{{ $request->offer->icon }}"></i>
				<span>{{ $request->offer->displayName }} application</span>
				<span class="font-bold">{{ $request->offer->title }}</span>
			</span>
		</x-slot:description>
		<x-slot:buttons>
			<div class="flex items-center gap-3">
				<a href="{{ route('requests.reject_confirm', $request) }}" class="btn bg-red-700 text-white">
					<i class="fa-solid fa-times"></i>
					Reject
				</a>
				<a href="{{ route('requests.document_confirm', $request) }}" class="btn bg-purple-700 text-white">
					<i class="fa-solid fa-file-lines"></i>
					Request documentation
				</a>
				<a href="{{ route('requests.accept_confirm', $request) }}" class="btn bg-green-700 text-white">
					<i class="fa-solid fa-check"></i>
					Accept
				</a>
			</div>
		</x-slot:buttons>
	</x-header>
	<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6">
		@if(session('error'))
			<div class="alert bg-red-700 text-white">
				<i class="fa-solid fa-triangle-exclamation"></i>
				{{ session('error') }}
			</div>
		@endif
	</div>
@endsection