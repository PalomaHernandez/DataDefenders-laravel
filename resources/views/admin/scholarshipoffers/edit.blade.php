@extends('layouts.admin')

@section('title')
	Edit Scholarship Offer: {{ $scholarshipoffer->name }}
@endsection

@section('content')
            <p class="my-super-title">Edit Scholarship Offer: {{ $scholarshipoffer->name }}</p>
            @if(session('error'))
                <div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
            @endif
            <form action="{{ route('scholarshipoffers.update',$scholarshipoffer) }}" method="post" class="flex-grow flex flex-col items-start gap-3">
                @csrf
                @method('PATCH')
                <label for="name">Title</label>
                <input type="text" id="title" name="title" class="px-2 py-1 rounded border border-sky-400 w-full" value="{{ old('title') ? old('title') : $scholarshipoffer->title }}">
                <label for="name">Description</label>
                <textarea id="description" name="description" class="px-2 py-1 rounded border border-sky-400 w-full min-h-[200px]">{{old('description') ?  old('description') : $scholarshipoffer->description }}</textarea>
                <label for="name">Requirements</label>
                <textarea id="requirements" name="requirements" class="px-2 py-1 rounded border border-sky-400 w-full min-h-[200px]">{{ old('requirements')? old('requirements') : $scholarshipoffer->requirements}}</textarea>
                @if($scholarshipoffer->visible)
                    <p>Visible</p>
                @endif
                <div class="flex gap-4">
                    <a href="{{ back()->getTargetUrl() }}" class="text-red-700 rounded px-3 py-2">Back</a>
                    <button type="submit" class="bg-green-700 rounded px-3 py-2 text-white">Update</button>
                </div>
            </form>
@endsection