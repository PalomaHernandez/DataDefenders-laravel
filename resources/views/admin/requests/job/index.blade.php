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
	@include('layouts.messages')
	<div class="flex-grow overflow-y-auto flex flex-col">
		@include('layouts.pagination', ['paginated' => $requests])
		<div class="items">
			@foreach($requests as $request)
				@include('admin.requests.item')
			@endforeach
		</div>
		@include('layouts.pagination', ['paginated' => $requests])
	</div>
@endsection