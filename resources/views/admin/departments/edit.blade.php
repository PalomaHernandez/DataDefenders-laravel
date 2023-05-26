@extends('layouts.app')

@section('title')
	Edit Department: {{ $department->name }}
@endsection

@section('content')
	<form action="{{ route('departments.update', $department) }}" method="post" class="h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('departments.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				{{ $department->name }}
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-university"></i>
					Department
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<div class="flex items-center gap-3">
					@can('delete.departments')
						<a href="{{ route('departments.delete_confirm', $department) }}" class="btn-outline border-gray-300 text-gray-600 hover:bg-red-50 hover:border-red-200 hover:text-red-400">
							<i class="fa-solid fa-trash"></i>
							Delete
						</a>
					@endcan
					@can('edit.departments')
						<button type="submit" class="btn btn-primary">
							<i class="fa-solid fa-check"></i>
							Save changes
						</button>
					@endcan
				</div>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="labeled-input">
					<label for="name">Name</label>
					<input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $department->name }}">
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection