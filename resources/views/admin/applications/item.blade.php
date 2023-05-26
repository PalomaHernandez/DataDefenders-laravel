<a class="item flex items-center gap-2" href="{{ route('applications.edit', $application) }}">
	<div class="flex-grow">
		<p class="font-medium text-lg">{{ $application->user->fullNameReversed }}</p>
		<p class="text-sm text-gray-400 flex items-center gap-2">
			<i class="fa-solid fa-{{ $application->offer->icon }} text-gray-400"></i>
			{{ $application->offer->title }}
		</p>
	</div>
	<p class="text-gray-400">{{ $application->offer->displayName }}</p>
	<i class="fa-solid fa-chevron-right text-gray-400"></i>
</a>