@extends('layouts.app')

@section('title')
	Application by {{ $request->user->fullName }}
@endsection

@section('content')
	<x-header>
		<x-slot:title>{{ $request->user->fullName }}</x-slot:title>
		<x-slot:description>
			<span class="icon-text">
				<i class="fa-solid fa-{{ $request->offer->icon }}"></i>
				<span>{{ $request->offer->displayName }} application</span>
				<span class="font-bold">{{ $request->offer->title }}</span>
			</span>
			@include('admin.requests.status')
		</x-slot:description>
		<x-slot:buttons>
			@if($request->canUpdate)
				<div class="flex items-center gap-3">
					@can('reject.requests')
						<a href="{{ route('requests.reject_confirm', $request) }}" class="btn bg-red-700 text-white">
							<i class="fa-solid fa-times"></i>
							Reject
						</a>
					@endcan
					@can('require.request.documentation')
						<a href="{{ route('requests.document_confirm', $request) }}" class="btn bg-purple-700 text-white">
							<i class="fa-solid fa-file-lines"></i>
							Request documentation
						</a>
					@endcan
					@can('accept.requests')
						<a href="{{ route('requests.accept_confirm', $request) }}" class="btn bg-green-700 text-white">
							<i class="fa-solid fa-check"></i>
							Accept
						</a>
					@endcan
				</div>
			@endif
		</x-slot:buttons>
	</x-header>
	<x-body>
		<x-slot:content>
			<p class="text-3xl font-medium">Documentation</p>
			<div class="flex items-center gap-3 flex-wrap">
				@foreach($request->documentationFiles as $file)
					<a href="{{ $file->path }}" target="_blank" class="flex items-center gap-3 rounded-lg bg-purple-100 px-3 py-2 text-gray-600 hover:bg-purple-200">
						<i class="fa-solid fa-file-lines"></i>
						{{ $file->created_at->format('m/d/Y H:i') }}
					</a>
				@endforeach
			</div>
			<p class="text-3xl font-medium">Comments</p>
			@foreach($request->comments as $comment)
				<div class="flex flex-col gap-3 rounded-lg bg-gray-100 p-4">
					<p class="text-lg"><span class="font-bold">{{ $comment->user->full_name }}</span> on {{ $comment->created_at->format('m/d/Y') }} at {{ $comment->created_at->format('H:i') }} wrote:</p>
					<p>{{ $comment->text }}</p>
				</div>
			@endforeach
		</x-slot:content>
	</x-body>
@endsection