@extends('layouts.app')

@section('title')
	Create Major
@endsection

@section('content')
	<form action="{{ route('majors.store') }}" method="post" class="h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('majors.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Create Major
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-scroll"></i>
					Major
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<button type="submit" class="btn btn-primary">
					<i class="fa-solid fa-plus"></i>
					Add major
				</button>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="flex items-center gap-3">
					<div class="labeled-input flex-grow">
						<label for="name">Name</label>
						<input type="text" id="name" name="name" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('name') }}">
					</div>
					<div class="labeled-input">
						<label>Department</label>
						<input type="hidden" name="department_id" value="{{ $department->id }}">
						<p class="fake-disabled">{{ $department->name }}</p>
					</div>
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection