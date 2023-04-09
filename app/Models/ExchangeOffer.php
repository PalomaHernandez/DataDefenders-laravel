<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Traits\HasRequests;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExchangeOffer extends Model implements Offer {

	use HasFactory, HasRequests;

	protected $fillable = [
		'title',
		'description',
		'requirements',
		'university_id',
		'starts_at',
		'ends_at',
		'visible',
	];

	public function majors():BelongsToMany{
		return $this->belongsToMany(Major::class, 'exchange_offer_major');
	}

	public function university():BelongsTo{
		return $this->belongsTo(University::class);
	}

}
