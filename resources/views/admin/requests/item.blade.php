<a class="item flex items-center gap-2" href="{{ route('requests.edit', $request) }}">
	<div class="flex-grow">
		<p class="font-medium text-lg">{{ $request->user->fullNameReversed }}</p>
		<p class="text-sm text-gray-400 flex items-center gap-2">
			<i class="fa-solid fa-{{ $request->offer->icon }} text-gray-400"></i>
			{{ $request->offer->title }}
		</p>
	</div>
	<p class="text-gray-400">{{ $request->offer->displayName }}</p>
	<i class="fa-solid fa-chevron-right text-gray-400"></i>
</a>