@extends('layouts.app')

@section('title')
	Delete Scholarship Offer
@endsection

@section('content')
	<x-header>
		<x-slot:title>Delete Scholarship Offer</x-slot:title>
		<x-slot:description>Delete the selected scholarship offer.</x-slot:description>
		<x-slot:buttons>
			<form action="{{ route('offers.scholarship.delete', $offer) }}" method="post">
				@csrf
				@method('delete')
				<button type="submit" class="btn bg-red-700 text-white">
					<i class="fa-solid fa-trash"></i>
					Delete permanently
				</button>
			</form>
		</x-slot:buttons>
	</x-header>
	<x-body>
		<x-slot:content>
			<p class="font-bold">Are you sure? This will delete "{{ $offer->title }}" permanently.</p>
		</x-slot:content>
	</x-body>
@endsection