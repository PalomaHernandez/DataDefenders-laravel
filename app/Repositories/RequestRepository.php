<?php

namespace App\Repositories;

use App\Models\Request;
use App\Patterns\State\Request\RequestStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RequestRepository {

	public function getByStatus(RequestStatus $status, bool $paginated = false):array|LengthAwarePaginator|Collection{
		$requests = Request::whereStatus($status);
		if($paginated){
			return $requests->paginate();
		}
		return $requests->get();
	}

	public function getByOfferType(string $offerType, RequestStatus $status, bool $paginated = false):array|LengthAwarePaginator|Collection{
		$requests = Request::whereOfferType($offerType)->whereStatus($status);
		if($paginated){
			return $requests->paginate();
		}
		return $requests->get();
	}

}