<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Offer {

	public function requests():MorphMany;

	public function acceptedRequests():MorphMany;

	public function rejectedRequests():MorphMany;

	public function pendingRequests():MorphMany;

	public function documentationRequests():MorphMany;

}