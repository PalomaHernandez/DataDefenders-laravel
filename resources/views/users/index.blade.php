@extends('layouts.app')

@section('title')
    My account
@endsection

@section('content')
		@csrf
		<x-header>
			<x-slot:title>My account</x-slot:title>
			<x-slot:description></x-slot:description>
			<x-slot:buttons>
				<a href="{{ route('users.edit') }}" class="btn btn-primary">
					Edit profile
				</a>
			</x-slot:buttons>
		</x-header>
		<x-form-body>
			<x-slot:content>
				<div class="flex items-center gap-2">
					<i class="fa fa-user-circle-o text-3xl font-bold text-sky-700" aria-hidden="true"></i> 
					<p class="flex-grow font-medium text-xl">{{ $user->fullName }}</p>
				</div>
				<div class=" overflow-y-auto flex flex-col gap-3 rounded-lg bg-gray-100 p-4">
					<div class="flex gap-2">
						<p class="font-medium text-base">ID:</p>
						<p class="font-normal text-base">{{ $user->id_card }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">Email:</p>
						<p class="font-normal text-base">{{ $user->email }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">Phone:</p>
						<p class="font-normal text-base">{{ $user->phone }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">Address line 1:</p>
						<p class="font-normal text-base">{{ $user->address_line_1 }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">Address line 2:</p>
						<p class="font-normal text-base">{{ $user->address_line_2 }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">City:</p>
						<p class="font-normal text-base">{{ $user->city }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">Region:</p>
						<p class="font-normal text-base">{{ $user->region }}</p>
					</div>
					<div class="flex gap-2">
						<p class="font-medium text-base">Country:</p>
						<p class="font-normal text-base">{{ $user->country }}</p>
					</div>
				</div>
			</x-slot:content>
		</x-form-body>
@endsection