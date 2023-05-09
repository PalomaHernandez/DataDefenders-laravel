@if($offer->applications_count == 1)
	<p class="text-gray-400">1 applicant</p>
@else
	<p class="text-gray-400">{{ $offer->applications_count }} applicants</p>
@endif