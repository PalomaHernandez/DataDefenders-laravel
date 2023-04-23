@extends('layouts.app')

@section('title')
	Create Department
@endsection

@section('content')
	<form action="{{ route('departments.store') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('departments.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Create Department
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-university"></i>
					Department
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<button type="submit" class="btn bg-sky-700 text-white">
					<i class="fa-solid fa-plus"></i>
					Add new
				</button>
			</x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6">
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
			<div class="labeled-input">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" value="{{ old('name') }}">
			</div>
		</div>
	</form>
@endsection