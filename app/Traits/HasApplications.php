<?php

namespace App\Traits;

use App\Models\Application;
use App\Patterns\State\Request\ApplicationStatus;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasApplications {

	public function applications():MorphMany{
		return $this->morphMany(Application::class, 'offer');
	}

	public function acceptedApplications():MorphMany{
		return $this->morphMany(Application::class, 'offer')->where('status', '=', ApplicationStatus::Accepted);
	}

	public function paymentApplications():MorphMany{
		return $this->morphMany(Application::class, 'offer')->where('status', '=', ApplicationStatus::Payment);
	}

	public function rejectedApplications():MorphMany{
		return $this->morphMany(Application::class, 'offer')->where('status', '=', ApplicationStatus::Rejected);
	}

	public function pendingApplications():MorphMany{
		return $this->morphMany(Application::class, 'offer')->where('status', '=', ApplicationStatus::Pending);
	}

	public function documentationApplications():MorphMany{
		return $this->morphMany(Application::class, 'offer')->where('status', '=', ApplicationStatus::Documentation);
	}

}