@extends('layouts.app')

@section('title')
	Edit Major: {{ $major->name }}
@endsection

@section('content')
	<form action="{{ route('majors.update',$major) }}" method="post" class="h-screen flex flex-col">
		@csrf
		@method('PATCH')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ back()->getTargetUrl() }}">
					<i class="fa-solid fa-chevron-left"></i> </a> Edit "{{ $major->name }}"
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-scroll"></i>
					Major
				</span> <span class="icon-text">
					<i class="fa-solid fa-university"></i>
					{{ $major->department->name }}
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<div class="flex items-center gap-3">
					<a href="{{ route('majors.delete_confirm', $major) }}" class="btn-outline border-gray-300 text-gray-600 hover:bg-red-50 hover:border-red-200 hover:text-red-400">
						<i class="fa-solid fa-trash"></i> Delete </a>
					<button type="submit" class="btn btn-primary">
						<i class="fa-solid fa-check"></i> Save changes
					</button>
				</div>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="labeled-input">
					<label for="name">Name</label>
					<input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $major->name }}">
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection