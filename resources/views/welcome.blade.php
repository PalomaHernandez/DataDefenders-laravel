@extends('layouts.app')

@section('title')
	Home
@endsection

@section('content')
<form action="{{ route('logout') }}" method="get">
	<x-header>
		<x-slot:title>Home</x-slot:title>
		<x-slot:description>Find quick links and overall information.</x-slot:description>
		@auth
		<x-slot:buttons>
			<button type="submit" class="btn bg-sky-700 text-white">
					Log out
			</button>
		</x-slot:buttons>		
		@else
		<x-slot:buttons>
			<button  class="btn bg-sky-700 text-white">
				<a href="{{ route('login') }}">
					Log in
				</a>
			</button>
		</x-slot:buttons>
		@endauth
	</x-header>
</form>
@endsection