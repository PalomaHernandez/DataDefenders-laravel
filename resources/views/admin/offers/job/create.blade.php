@extends('layouts.app')

@section('title')
	Create Job Offer
@endsection

@section('content')
	<form action="{{ route('offers.job.store') }}" method="post" class="h-screen flex flex-col">
		@csrf
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ route('offers.job.index') }}">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				Create Job Offer
			</x-slot:title>
			<x-slot:description>
				<p class="icon-text">
					<i class="fa-solid fa-graduation-cap"></i>
					Job Offer
				</p>
			</x-slot:description>
			<x-slot:buttons>
				<div class="flex items-center gap-6">
					<div class="flex items-center gap-2">
						<input type="checkbox" id="visible" name="visible" value="1" class="leading-none">
						<label for="visible" class="select-none">Visible</label>
					</div>
					<button type="submit" class="btn btn-primary">
						<i class="fa-solid fa-plus"></i>
						Add new
					</button>
				</div>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="labeled-input">
					<label for="title">Title</label>
					<input type="text" id="title" name="title">
				</div>
				<div class="flex items-center gap-4">
					<div class="labeled-input flex-grow">
						<label for="department_id">Department</label> <select id="department_id" name="department_id">
							@foreach($departments as $department)
								<option value="{{ $department->id }}">{{ $department->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="labeled-input">
						<label for="starts_at">Starts at</label>
						<input type="datetime-local" id="starts_at" name="starts_at">
					</div>
					<div class="labeled-input">
						<label for="ends_at">Ends at</label>
						<input type="datetime-local" id="ends_at" name="ends_at">
					</div>
					<div class="labeled-input">
						<label for="interview_at">Interview at</label>
						<input type="datetime-local" id="interview_at" name="interview_at">
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
				<div class="labeled-input">
					<label for="benefits">Benefits</label>
					<textarea id="benefits" name="benefits">{{ old('benefits') }}</textarea>
				</div>
			</x-slot:content>
		</x-form-body>
	</form>
@endsection