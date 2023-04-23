@extends('layouts.app')

@section('title')
	Majors
@endsection

@section('content')
	<x-header>
		<x-slot:title>Majors</x-slot:title>
		<x-slot:description>Manage the majors that may offer scholarships.</x-slot:description>
		<x-slot:buttons></x-slot:buttons>
	</x-header>
	<div class="flex-grow overflow-y-auto flex flex-col">
		@if(session('success'))
			<div class="px-3 py-2 bg-green-700 text-white rounded">{{ session('success') }}</div>
		@endif
		@if(session('error'))
			<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
		@endif
		@foreach($departments as $department)
			<div class="flex items-center gap-6 pl-8 pr-3 py-4 sticky top-0 bg-sky-100">
				<p class="flex-grow flex items-center gap-2 font-bold text-lg text-sky-700">
					<i class="fa-solid fa-university"></i>
					{{ $department->name }}
				</p>
				<a href="{{ route('majors.create', $department) }}" class="btn bg-sky-700 text-white">
					<i class="fa-solid fa-plus"></i>
					Add new major
				</a>
			</div>
			<div class="items">
				@foreach($department->majors as $major)
					<a class="item flex items-center gap-2" href="{{ route('majors.edit',$major) }}">
						<i class="fa-solid fa-scroll text-gray-400"></i>
						<p class="flex-grow">{{ $major->name }}</p>
						<i class="fa-solid fa-chevron-right text-gray-400"></i>
					</a>
				@endforeach
			</div>
		@endforeach
	</div>
@endsection
