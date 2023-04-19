<?php

namespace App\Traits;

use App\Models\Request;
use App\Patterns\State\Request\RequestStatus;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRequests {

	public function requests():MorphMany{
		return $this->morphMany(Request::class, 'offer');
	}

	public function acceptedRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', RequestStatus::Accepted); // TODO: implement status
	}

	public function rejectedRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', RequestStatus::Rejected); // TODO: implement status
	}

	public function pendingRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', RequestStatus::Pending); // TODO: implement status
	}

	public function documentationRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', RequestStatus::Documentation); // TODO: implement status
	}

}