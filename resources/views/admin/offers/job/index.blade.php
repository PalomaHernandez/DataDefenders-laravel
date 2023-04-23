@extends('layouts.app')

@section('title')
	Job Offers
@endsection

@section('content')
	<x-header>
		<x-slot:title>Job Offers</x-slot:title>
		<x-slot:description>Manage the job offers that people may apply to.</x-slot:description>
		<x-slot:buttons>
			<a href="{{ route('offers.job.create') }}" class="btn bg-sky-700 text-white">
				<i class="fa-solid fa-plus"></i> Add new </a>
		</x-slot:buttons>
	</x-header>
	<div class="flex-grow overflow-y-auto flex flex-col gap-6">
		@if(session('success'))
			<div class="px-3 py-2 bg-green-700 text-white rounded">{{ session('success') }}</div>
		@endif
		@if(session('error'))
			<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
		@endif
		<div class="items">
			@foreach($offers as $offer)
				<a class="item flex items-center gap-2" href="{{ route('offers.job.edit', $offer) }}">
					<i class="fa-solid fa-briefcase text-gray-400"></i>
					<p class="flex-grow">{{ $offer->title }}</p>
					<i class="fa-solid fa-chevron-right text-gray-400"></i>
				</a>
			@endforeach
		</div>
	</div>
@endsection