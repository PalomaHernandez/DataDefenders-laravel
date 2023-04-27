<?php

namespace App\Repositories;

use App\Contracts\RequestRepository;
use App\Models\JobOffer;
use App\Models\Request;
use App\Patterns\State\Request\RequestStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobRequestRepository implements RequestRepository {

	public function findById(int $id):Request{
		return Request::whereOfferType(JobOffer::class)->whereId($id)->firstOrFail();
	}

	public function getAllPending():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Pending)->get();
	}

	public function getAllDocumentation():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Documentation)->get();
	}

	public function getAllAccepted():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Accepted)->get();
	}

	public function getAllRejected():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Rejected)->get();
	}

	public function getAllPendingPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Pending)->paginate();
	}

	public function getAllDocumentationPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Documentation)->paginate();
	}

	public function getAllAcceptedPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Accepted)->paginate();
	}

	public function getAllRejectedPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Rejected)->paginate();
	}

}