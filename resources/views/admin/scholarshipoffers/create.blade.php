@extends('layouts.admin')

@section('title')
	Create Scholarship Offer
@endsection

@section('content')
		<p class="my-super-title">Create Scholarship Offer</p>
		@if(session('error'))
			<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
		@endif
		<form action="{{ route('scholarshipoffers.store') }}" method="post" class="flex flex-col items-start gap-3">
			@csrf
			<label for="title">Title</label>
			<input type="text" id="title" name="title" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('title') }}">
            <label for="description">Description</label>
			<input type="text" id="description" name="description" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('description') }}">
            <label for="requirements">Requirements</label>
			<input type="text" id="requirements" name="requirements" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('requirements') }}">
			
            <div class="flex items-center">
                <input type="date" id="starts_at" name="starts_at">
                <span class="mx-4 text-gray-500">to</span>
                <input type="date" id="ends_at" name="ends_at">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="visible" name="visible" value="1" class="leading-none"> 
                <label for="visible">Visible</label>
            </div>

            <div class="flex gap-4">
				<a href="{{ back()->getTargetUrl() }}" class="text-red-700 rounded px-3 py-2">Back</a>
				<button type="submit" class="bg-green-700 rounded px-3 py-2 text-white">Create</button>
			</div>
		</form>
@endsection