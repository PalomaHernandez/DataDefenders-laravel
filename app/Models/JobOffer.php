<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Traits\HasRequests;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobOffer extends Model implements Offer {

	use HasFactory, HasRequests;

	protected $fillable = [
		'title',
		'description',
		'requirements',
		'benefits',
		'interview_at',
		'department_id',
		'starts_at',
		'ends_at',
		'visible',
	];

	public function department():BelongsTo{
		return $this->belongsTo(Department::class);
	}

}
