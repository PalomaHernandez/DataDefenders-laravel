@extends('layouts.app')

@section('title')
	Edit Job Offer: {{ $offer->title }}
@endsection

@section('content')
	<form action="{{ route('departments.update', $offer) }}" method="post" class="h-screen flex flex-col">
		@csrf
		@method('patch')
		<x-header>
			<x-slot:title>
				<a class="text-lg text-gray-400" href="{{ back()->getTargetUrl() }}">
					<i class="fa-solid fa-chevron-left"></i> </a>
				{{ $offer->title }}
			</x-slot:title>
			<x-slot:description>
				<span class="icon-text">
					<i class="fa-solid fa-briefcase"></i>
					Job Offer
				</span>
			</x-slot:description>
			<x-slot:buttons>
				<div class="flex items-center gap-3">
					@if($offer->visible)
						<a href="{{ route('offers.job.visible.toggle', $offer) }}" class="btn bg-green-400 text-white hover:bg-green-500">Visible</a>
					@else
						<a href="{{ route('offers.job.visible.toggle', $offer) }}" class="btn bg-red-400 text-white hover:bg-red-500">Hidden</a>
					@endif
					<a href="{{ route('offers.job.delete_confirm', $offer) }}" class="btn-outline border-gray-300 text-gray-600 hover:bg-red-50 hover:border-red-200 hover:text-red-400">
						<i class="fa-solid fa-trash"></i>
						Delete
					</a>
					<button type="submit" class="btn bg-sky-700 text-white">
						<i class="fa-solid fa-check"></i>
						Save changes
					</button>
				</div>
			</x-slot:buttons>
		</x-header>
		<div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6 lg:p-8">
			@if(session('error'))
				<div class="alert bg-red-700 text-white">
					<i class="fa-solid fa-triangle-exclamation"></i>
					{{ session('error') }}
				</div>
			@endif
			<div class="labeled-input">
				<label for="title">Title</label>
				<input type="text" id="title" name="title" value="{{ old('title') ? old('title') : $offer->title }}">
			</div>
			<div class="flex items-center gap-4">
				<div class="labeled-input flex-grow">
					<label for="department_id">Department</label> <select id="department_id" name="department_id">
						@foreach($departments as $department)
							<option value="{{ $department->id }}" @if((old('department_id') ? old('department_id') : $offer->department_id) == $department->id) selected @endif>{{ $department->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="labeled-input">
					<label for="starts_at">Starts at</label>
					<input type="datetime-local" id="starts_at" name="starts_at" value="{{ $offer->starts_at }}">
				</div>
				<div class="labeled-input">
					<label for="ends_at">Ends at</label>
					<input type="datetime-local" id="ends_at" name="ends_at" value="{{ $offer->ends_at }}">
				</div>
				<div class="labeled-input">
					<label for="interview_at">Interview at</label>
					<input type="datetime-local" id="interview_at" name="interview_at" value="{{ $offer->interview_at }}">
				</div>
			</div>
			<div class="labeled-input">
				<label for="description">Description</label> <textarea id="description" name="description">{{ old('description') ? old('description') : $offer->description }}</textarea>
			</div>
			<div class="labeled-input">
				<label for="requirements">Requirements</label> <textarea id="requirements" name="requirements">{{ old('requirements') ? old('requirements') : $offer->requirements }}</textarea>
			</div>
			<div class="labeled-input">
				<label for="benefits">Benefits</label> <textarea id="benefits" name="benefits">{{ old('benefits') ? old('benefits') : $offer->benefits }}</textarea>
			</div>
		</div>
	</form>
@endsection