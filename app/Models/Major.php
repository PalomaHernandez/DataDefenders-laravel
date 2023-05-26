<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Major extends Model {

	use HasFactory;

	protected $guarded = [
		'id'
	];

	public function department():BelongsTo{
		return $this->belongsTo(Department::class);
	}

	public function scholarshipOffers():BelongsToMany{
		return $this->belongsToMany(ScholarshipOffer::class, 'scholarship_offer_major');
	}

}
