@extends('layouts.app')

@section('title')
	Application by {{ $application->user->fullName }}
@endsection

@section('content')
	<x-header>
		<x-slot:title>{{ $application->user->fullName }}</x-slot:title>
		<x-slot:description>
			<span class="icon-text">
				<i class="fa-solid fa-{{ $application->offer->icon }}"></i>
				<span>{{ $application->offer->displayName }} application</span>
				<span class="font-bold">{{ $application->offer->title }}</span>
			</span>
			@include('admin.applications.status')
		</x-slot:description>
		<x-slot:buttons>
			@if($application->canUpdate)
				<div class="flex items-center gap-3">
					@can('reject.applications')
						<a href="{{ route('applications.reject_confirm', $application) }}" class="btn bg-red-700 text-white">
							<i class="fa-solid fa-times"></i> Reject </a>
					@endcan
					@can('require.application.documentation')
						<a href="{{ route('applications.document_confirm', $application) }}" class="btn bg-purple-700 text-white">
							<i class="fa-solid fa-file-lines"></i> Request documentation </a>
					@endcan
					@can('accept.applications')
						<a href="{{ route('applications.accept_confirm', $application) }}" class="btn bg-green-700 text-white">
							<i class="fa-solid fa-check"></i> Accept </a>
					@endcan
				</div>
			@endif
		</x-slot:buttons>
	</x-header>
	<x-body>
		<x-slot:content>
			<p class="text-3xl font-medium">Documentation</p>
			<div class="flex items-center gap-3 flex-wrap">
				@foreach($application->documentationFiles as $file)
					<a href="{{ $file->path }}" target="_blank" class="flex items-center gap-3 rounded-lg bg-purple-100 px-3 py-2 text-gray-600 hover:bg-purple-200">
						<i class="fa-solid fa-file-lines"></i>
						{{ $file->created_at->format('m/d/Y H:i') }}
					</a>
				@endforeach
			</div>
			<p class="text-3xl font-medium">Comments</p>
			@foreach($application->comments as $comment)
				<div class="flex flex-col gap-3 rounded-lg bg-gray-100 p-4">
					<p class="text-lg">
						<span class="font-bold">{{ $comment->user->full_name }}</span> on {{ $comment->created_at->format('m/d/Y') }} at {{ $comment->created_at->format('H:i') }} wrote:
					</p>
					<p>{{ $comment->text }}</p>
				</div>
			@endforeach
		</x-slot:content>
	</x-body>
@endsection