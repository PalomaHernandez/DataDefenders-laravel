@extends('layouts.app')

@section('title')
	Delete
@endsection

@section('content')
	<x-header>
		<x-slot:title>Delete Major</x-slot:title>
		<x-slot:description>Delete the selected major.</x-slot:description>
		<x-slot:buttons>
			<form action="{{ route('majors.delete', $major) }}" method="post">
				@csrf
				@method('delete')
				<button type="submit" class="btn bg-red-700 text-white">
					<i class="fa-solid fa-trash"></i> Delete permanently
				</button>
			</form>
		</x-slot:buttons>
	</x-header>
	<x-body>
		<x-slot:content>
			<p class="font-bold">Are you sure? This will delete "{{ $major->name }}" permanently.</p>
		</x-slot:content>
	</x-body>
@endsection