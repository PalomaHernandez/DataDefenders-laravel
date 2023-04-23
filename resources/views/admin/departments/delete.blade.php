@extends('layouts.app')

@section('title')
	Delete "{{ $department->name }}"
@endsection

@section('content')
		<x-header>
		<x-slot:title>
			<a class="text-lg text-gray-400" href="{{ route('departments.edit', $department) }}">
				<i class="fa-solid fa-chevron-left"></i>
			</a>
			Delete Department
		</x-slot:title>
		<x-slot:description>Delete the selected department.</x-slot:description>
		<x-slot:buttons>
			<form action="{{ route('departments.delete', $department) }}" method="post">
				@csrf
				@method('delete')
				<button type="submit" class="btn bg-red-700 text-white">
					<i class="fa-solid fa-trash"></i>
					Delete permanently
				</button>
			</form>
		</x-slot:buttons>
	</x-header>
	<div class="flex flex-col items-start gap-3 p-6">
		<p class="font-bold">Are you sure? This will delete "{{ $department->name }}" permanently.</p>
	</div>
@endsection