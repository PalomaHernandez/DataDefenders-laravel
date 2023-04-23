@extends('layouts.app')

@section('title')
    Edit Scholarship Offer: {{ $offer->name }}
@endsection

@section('content')
    <form action="{{ route('offers.scholarship.update', $offer) }}" method="post" class="h-screen flex flex-col">
        @csrf
        @method('PATCH')
        <x-header>
            <x-slot:title>
                <a class="text-lg text-gray-400" href="{{ route('offers.scholarship.index') }}">
                    <i class="fa-solid fa-chevron-left"></i> </a> Edit "{{ $offer->title }}"
            </x-slot:title>
            <x-slot:description>
                <p class="icon-text">
                    <i class="fa-solid fa-graduation-cap"></i> Scholarship Offer </p>
            </x-slot:description>
            <x-slot:buttons>
                <div class="flex items-center gap-4">
                    @if($offer->visible)
                        <a href="{{ route('offers.scholarship.visible.toggle', $offer) }}" class="btn bg-green-400 text-white hover:bg-green-500">Visible</a>
                    @else
                        <a href="{{ route('offers.scholarship.visible.toggle', $offer) }}" class="btn bg-red-400 text-white hover:bg-red-500">Hidden</a>
                    @endif
                    <a href="{{ route('offers.scholarship.delete_confirm', $offer) }}" class="btn-outline border-gray-300 text-gray-600 hover:bg-red-50 hover:border-red-200 hover:text-red-400">
                        <i class="fa-solid fa-trash"></i> Delete </a>
                    <button type="submit" class="btn bg-sky-700 text-white">
                        <i class="fa-solid fa-check"></i> Save changes
                    </button>
                </div>
            </x-slot:buttons>
        </x-header>
        <div class="flex-grow overflow-y-auto flex flex-col gap-6 p-6 lg:p-8">
            @if(session('error'))
                <div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
            @endif
            <div class="flex items-center gap-4">
                <div class="labeled-input flex-grow">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') ? old('title') : $offer->title }}">
                </div>
                <div class="labeled-input">
                    <label for="starts_at">Starts at</label>
                    <input type="datetime-local" id="starts_at" name="starts_at" value="{{ $offer->starts_at }}">
                </div>
                <div class="labeled-input">
                    <label for="ends_at">Ends at</label>
                    <input type="datetime-local" id="ends_at" name="ends_at" value="{{ $offer->ends_at }}">
                </div>
            </div>
            <div class="labeled-input">
                <label for="description">Description</label> <textarea id="description" name="description">{{ old('description') ? old('description') : $offer->description }}</textarea>
            </div>
            <div class="labeled-input">
                <label for="requirements">Requirements</label> <textarea id="requirements" name="requirements">{{ old('requirements') ? old('requirements') : $offer->requirements }}</textarea>
            </div>
        </div>
    </form>
@endsection