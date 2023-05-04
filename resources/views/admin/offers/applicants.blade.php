@if($offer->requests_count == 1)
	<p class="text-gray-400">1 applicant</p>
@else
	<p class="text-gray-400">{{ $offer->requests_count }} applicants</p>
@endif