@extends('layouts.app')

@section('title')
	Delete Scholarship Offer
@endsection

@section('content')
	<div class="flex flex-col gap-6">
		<x-header>
			<x-slot:title>Delete Scholarship Offer</x-slot:title>
			<x-slot:description>Delete the selected scholarship offer.</x-slot:description>
			<x-slot:buttons>
				<form action="{{ route('offers.scholarship.delete', $offer) }}" method="post">
					@csrf
					@method('delete')
					<button type="submit" class="btn bg-red-700 text-white">
						<i class="fa-solid fa-trash"></i> Delete permanently
					</button>
				</form>
			</x-slot:buttons>
		</x-header>
		@if(session('error'))
			<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
		@endif
		<div class="flex flex-col items-start gap-3">
			<p class="font-bold">Are you sure? This will delete "{{ $offer->name }}" permanently.</p>
		</div>
	</div>
@endsection