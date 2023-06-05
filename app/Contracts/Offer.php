<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Offer {

	public function applications():MorphMany;

	public function acceptedApplications():MorphMany;

	public function rejectedApplications():MorphMany;

	public function pendingApplications():MorphMany;

	public function documentationApplications():MorphMany;

	public function displayName():Attribute;

	public function icon():Attribute;

	public function isJobOffer():Attribute;

	public function isScholarshipOffer():Attribute;

	public function hasApplied():Attribute;

}