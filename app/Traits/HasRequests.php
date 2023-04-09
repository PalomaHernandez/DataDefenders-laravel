<?php

namespace App\Traits;

use App\Models\Request;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRequests {

	public function requests():MorphMany{
		return $this->morphMany(Request::class, 'offer');
	}

	public function acceptedRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', 'accepted'); // TODO: implement status
	}

	public function rejectedRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', 'rejected'); // TODO: implement status
	}

	public function pendingRequests():MorphMany{
		return $this->morphMany(Request::class, 'offer')->where('status', '=', 'pending'); // TODO: implement status
	}

}