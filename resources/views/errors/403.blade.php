@extends('layouts.app')

@section('title')
    Access forbidden
@endsection

@section('content')
    <div class="flex-grow flex flex-col items-center gap-6 p-10">
		<p class="text-5xl font-bold">Access forbidden</p>
		<p class="text-xl text-gray-600">{{ $exception->getMessage() }}</p>
		<a href="{{ back()->getTargetUrl() }}" class="btn bg-sky-700 text-white">Go back</a>
	</div>
@endsection