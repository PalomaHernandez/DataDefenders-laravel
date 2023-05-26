@extends('layouts.app')

@section('title')
	Create Scholarship Offer
@endsection

@section('content')
	<form action="{{ route('offers.scholarship.store') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('offers.scholarship.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Create Scholarship Offer
			</x-slot:title>
			<x-slot:description>
				<p class="icon-text">
					<i class="fa-solid fa-graduation-cap"></i>
					Scholarship Offer
				</p>
			</x-slot:description>
			<x-slot:buttons>
				<div class="flex items-center gap-6">
					<label for="public">Visibility</label>
					<select id="public" name="public">
						<option value="1">Public</option>
						<option value="0">Hidden</option>
					</select>
					@can('create.offers')
						<button type="submit" class="btn btn-primary">
							<i class="fa-solid fa-plus"></i>
							Add new
						</button>
					@endcan
				</div>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="flex items-center gap-4">
					<div class="labeled-input flex-grow">
						<label for="title">Title</label>
						<input type="text" id="title" name="title">
					</div>
					<div class="labeled-input">
						<label for="starts_at">Starts at</label>
						<input type="datetime-local" id="starts_at" name="starts_at">
					</div>
					<div class="labeled-input">
						<label for="ends_at">Ends at</label>
						<input type="datetime-local" id="ends_at" name="ends_at">
					</div>
				</div>
				<div class="labeled-input">
					<label for="description">Description</label>
					<textarea id="description" name="description">{{ old('description') }}</textarea>
				</div>
				<div class="labeled-input">
					<label for="requirements">Requirements</label>
					<textarea id="requirements" name="requirements">{{ old('requirements') }}</textarea>
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection