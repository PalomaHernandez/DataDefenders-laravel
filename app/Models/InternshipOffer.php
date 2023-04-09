<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Traits\HasRequests;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternshipOffer extends Model implements Offer {

	use HasFactory, HasRequests;

	protected $fillable = [
		'title',
		'description',
		'requirements',
		'company_id',
		'starts_at',
		'ends_at',
		'visible',
	];

	public function company():BelongsTo{
		return $this->belongsTo(Company::class);
	}

}
