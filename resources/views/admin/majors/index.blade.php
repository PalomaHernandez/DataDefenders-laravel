@extends('layouts.admin')

@section('title')
	Majors
@endsection

@section('content')
	<div class="flex flex-col items-start gap-6">
		<p class="my-super-title">Majors</p>
        @if(session('success'))
				<div class="px-3 py-2 bg-green-700 text-white rounded">{{ session('success') }}</div>
			@endif
			@if(session('error'))
				<div class="px-3 py-2 bg-red-700 text-white rounded">{{ session('error') }}</div>
			@endif
        @if(request()->has('delete'))
			<form action="{{ route('majors.delete', request('delete')) }}" method="post" class="flex flex-col items-start gap-3">
				@csrf
				@method('DELETE')
				<p class="font-bold">Are you sure to delete "{{ \App\Models\Major::find(request('delete'))->name }}"?</p>
				<button type="submit" class="bg-red-700 rounded px-3 py-2 text-white">Delete permanently</button>
			</form>
		@else
			<div class="w-full p-8">
                <section class="shadow row">
                    <div class="tabs">
                    @foreach($departments as $department)
                        <div class="flex items-center gap-4 hover:bg-sky-100 rounded px-2 py-1">
                            <div class="border-l-2 border-transparent">
                                <input class="w-full absolute z-10 cursor-pointer opacity-0 h-5 top-6" type="checkbox" id="chck1">
                                <header class="w-full flex justify-between items-center p-5 pl-8 pr-8 cursor-pointer select-none tab-label" for="chck1">
                                    <span class="text-grey-darkest font-thin text-xl">
                                        {{ $department->id }}. {{ $department->name }}
                                    </span>
                                    <div class="flex gap-4">
                                        <a href="{{route('majors.create', $department) }}" class="bg-green-700 rounded px-3 py-2 text-white">Add new major</a>
                                    </div>
                                    <div class="rounded-full border border-grey w-7 h-7 flex items-center justify-center test">
                                        <svg aria-hidden="true" class="" data-reactid="266" fill="none" height="24" stroke="#606F7B" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <polyline points="6 9 12 15 18 9">
                                            </polyline>
                                        </svg>
                                    </div>
                                </header>
                                    @foreach($department->majors as $major)
                                    <div class="tab-content">
                                        
                                            <ul class="pl-4">        
                                                <a href="{{ route('majors.edit',$major) }}" class="text-blue-700 rounded px-3 py-2">{{ $major->name }}</a> 
                                            </ul>
                                        
                                    </div>
                                    @endforeach
                                </div>
                        </div>               
                    @endforeach
                    </div>
                </section>
            </div>  
        @endif     
	</div>
@endsection
