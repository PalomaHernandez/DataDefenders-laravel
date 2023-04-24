@extends('layouts.app')

@section('title')
	Job Applications
@endsection

@section('content')
	<x-header>
		<x-slot:title>Job Applications</x-slot:title>
		<x-slot:description>Manage the pending job offer applications.</x-slot:description>
		<x-slot:buttons></x-slot:buttons>
	</x-header>
	@if(session('success'))
		<div class="alert bg-green-700 text-white">{{ session('success') }}</div>
	@endif
	@if(session('error'))
		<div class="alert bg-red-700 text-white">{{ session('error') }}</div>
	@endif
	<div class="flex-grow overflow-y-auto flex flex-col">
		<div class="items">
			@foreach($requests as $request)
				@include('admin.requests.item')
			@endforeach
		</div>
	</div>
@endsection