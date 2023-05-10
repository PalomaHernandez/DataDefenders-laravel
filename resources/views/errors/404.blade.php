@extends('layouts.app')

@section('title')
	Oops! This page does not exist!
@endsection

@section('content')
    <div class="flex-grow flex flex-col items-center gap-6 p-10">
		<p class="text-5xl font-bold">Oops! This page does not exist!</p>
		<p class="text-xl text-gray-600">{{ $exception->getMessage() }}</p>
		<a href="{{ back()->getTargetUrl() }}" class="btn btn-primary">Go back</a>
	</div>
@endsection