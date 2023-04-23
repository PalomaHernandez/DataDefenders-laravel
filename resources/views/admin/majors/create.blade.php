@extends('layouts.app')

@section('title')
	Create Major
@endsection

@section('content')
	<form action="{{ route('majors.store', $department) }}" method="post" class="h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ back()->getTargetUrl() }}">
					<i class="fa-solid fa-chevron-left"></i> </a> Create Major
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-scroll"></i>
					Major
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<button type="submit" class="btn bg-sky-700 text-white">
					<i class="fa-solid fa-plus"></i> Add major
				</button>
			</x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6 lg:p-8">
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
			<div class="flex items-center gap-4">
				<div class="labeled-input flex-grow">
					<label for="name">Name</label>
					<input type="text" id="name" name="name" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('name') }}">
				</div>
				<div class="labeled-input">
					<label for="department_id">Department</label>
					<select id="department_id" name="department_id" disabled>
						<option value="{{ $department->id }}">{{ $department->name }}</option>
					</select>
				</div>
			</div>
		</div>
	</form>
@endsection