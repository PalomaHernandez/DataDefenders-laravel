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
		</x-slot:description>
		<x-slot:buttons>
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
		</x-slot:buttons>
	</x-header>
	<x-body>
		<x-slot:content>

		</x-slot:content>
	</x-body>
@endsection