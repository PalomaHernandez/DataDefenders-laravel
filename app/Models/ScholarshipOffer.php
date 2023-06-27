<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Traits\HasApplications;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScholarshipOffer extends Model implements Offer {

	use HasFactory, HasApplications;

	protected $fillable = [
		'title',
		'description',
		'requirements',
		'starts_at',
		'ends_at',
		'public',
	];

	protected $casts = [
		'starts_at' => 'datetime',
		'ends_at' => 'datetime',
	];

	protected $appends = [
		'is_job_offer',
		'is_scholarship_offer',
		'has_applied',
	];
	
	public function majors():BelongsToMany{
		return $this->belongsToMany(Major::class, 'scholarship_offer_major');
	}

	public function displayName():Attribute{
		return Attribute::make(function (){
			return 'Scholarship offer';
		});
	}

	public function urlName():Attribute{
		return Attribute::make(function (){
			return 'scholarship';
		});
	}

	public function icon():Attribute{
		return Attribute::make(function (){
			return 'file-signature';
		});
	}

	public function isJobOffer():Attribute{
		return Attribute::make(function (){
			return false;
		});
	}

	public function isScholarshipOffer():Attribute{
		return Attribute::make(function (){
			return true;
		});
	}

	public function hasApplied():Attribute{
		return Attribute::make(function (){
			if(auth()->check()){
				return request()->user()->applications()->where('offer_id', '=', $this->id)->where('offer_type', '=', self::class)->exists();
			}
			return false;
		});
	}

}
