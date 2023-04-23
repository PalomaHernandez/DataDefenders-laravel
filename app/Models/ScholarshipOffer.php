<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Traits\HasRequests;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScholarshipOffer extends Model implements Offer {

	use HasFactory, HasRequests;

	protected $fillable = [
		'title',
		'description',
		'requirements',
		'starts_at',
		'ends_at',
		'visible',
	];

	protected $casts = [
		'starts_at' => 'datetime',
		'ends_at' => 'datetime',
	];

	public function majors():BelongsToMany{
		return $this->belongsToMany(Major::class, 'scholarship_offer_major');
	}

}
