@extends('layouts.app')

@section('title')
	All Applications
@endsection

@section('content')
	<x-header>
		<x-slot:title>All Applications</x-slot:title>
		<x-slot:description>Manage all the pending offer applications.</x-slot:description>
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