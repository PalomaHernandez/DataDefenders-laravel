@extends('layouts.admin')

@section('title')
	Scholarship Offers
@endsection

@section('content')
	<div class="flex flex-col items-start gap-6">
		<p class="my-super-title">Scholarship Offers</p>
		@if(request()->has('delete'))
			<form action="{{ route('scholarshipoffers.delete', request('delete')) }}" method="post" class="flex flex-col items-start gap-3">
				@csrf
				@method('DELETE')
				<p class="font-bold">Are you sure to delete "{{ \App\Models\ScholarshipOffer::find(request('delete'))->title }}"?</p>
				<button type="submit" class="bg-red-700 rounded px-3 py-2 text-white">Delete permanently</button>
			</form>
		@else
			<a href="{{ route('scholarshipoffers.create') }}" class="bg-green-700 rounded px-3 py-2 text-white">Add new</a>
			@if(session('success'))
				<div class="px-3 py-2 bg-green-700 text-white rounded">{{ session('success') }}</div>
			@endif
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
			<div class="w-full">
				@foreach($scholarshipoffers as $scholarshipoffer)
					<div class="flex items-center gap-4 hover:bg-sky-100 rounded px-2 py-1">
						<p class="flex-grow">{{ $scholarshipoffer->id }}. {{ $scholarshipoffer->title }}</p>
						<div class="flex gap-4">
							<a href="{{ route('scholarshipoffers.edit', $scholarshipoffer) }}" class="text-blue-700 rounded px-3 py-2">Edit</a>
							<a href="{{ route('scholarshipoffers.index', ['delete' => $scholarshipoffer->id]) }}" class="text-red-700 rounded px-3 py-2">Delete</a>
						</div>
					</div>
				@endforeach
			</div>
		@endif
	</div>
@endsection