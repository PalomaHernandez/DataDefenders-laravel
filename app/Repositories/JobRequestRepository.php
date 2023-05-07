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

	public function getAll():array|Collection{
		return Request::whereOfferType(JobOffer::class)->latest()->get();
	}

	public function getAllPending():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Pending)->latest()->get();
	}

	public function getAllDocumentation():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Documentation)->latest()->get();
	}

	public function getAllAccepted():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Accepted)->latest()->get();
	}

	public function getAllRejected():array|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Rejected)->latest()->get();
	}

	public function getAllPaginated():array|Collection{
		return Request::whereOfferType(JobOffer::class)->latest()->paginate();
	}

	public function getAllPendingPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Pending)->latest()->paginate();
	}

	public function getAllDocumentationPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Documentation)->latest()->paginate();
	}

	public function getAllAcceptedPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Accepted)->latest()->paginate();
	}

	public function getAllRejectedPaginated():array|LengthAwarePaginator|Collection{
		return Request::whereOfferType(JobOffer::class)->whereStatus(RequestStatus::Rejected)->latest()->paginate();
	}

}