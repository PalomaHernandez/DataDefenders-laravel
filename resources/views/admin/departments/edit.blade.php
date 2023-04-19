@extends('layouts.admin')

@section('title')
	Edit Department: {{ $department->name }}
@endsection

@section('content')
	<div class="flex flex-col gap-6">
		<p class="my-super-title">Edit Department: {{ $department->name }}</p>
		@if(session('error'))
			<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
		@endif
		<form action="{{ route('departments.update', $department) }}" method="post" class="flex flex-col items-start gap-3">
			@csrf
			@method('PATCH')
			<label for="name">Name</label>
			<input type="text" id="name" name="name" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('name') ? old('name') : $department->name }}">
			<div class="flex gap-4">
				<a href="{{ back()->getTargetUrl() }}" class="text-red-700 rounded px-3 py-2">Back</a>
				<button type="submit" class="bg-green-700 rounded px-3 py-2 text-white">Update</button>
			</div>
		</form>
	</div>
@endsection