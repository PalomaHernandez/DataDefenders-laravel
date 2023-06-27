<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Traits\HasApplications;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobOffer extends Model implements Offer {

	use HasFactory, HasApplications;

	protected $fillable = [
		'title',
		'description',
		'requirements',
		'benefits',
		'interview_at',
		'department_id',
		'starts_at',
		'ends_at',
		'public',
	];

	protected $casts = [
		'interview_at' => 'datetime',
		'starts_at' => 'datetime',
		'ends_at' => 'datetime',
	];

	protected $appends = [
		'is_job_offer',
		'is_scholarship_offer',
		'has_applied',
	];

	public function department():BelongsTo{
		return $this->belongsTo(Department::class);
	}

	public function displayName():Attribute{
		return Attribute::make(function (){
			return 'Job offer';
		});
	}

	public function urlName():Attribute{
		return Attribute::make(function (){
			return 'job';
		});
	}

	public function icon():Attribute{
		return Attribute::make(function (){
			return 'file-contract';
		});
	}

	public function isJobOffer():Attribute{
		return Attribute::make(function (){
			return true;
		});
	}

	public function isScholarshipOffer():Attribute{
		return Attribute::make(function (){
			return false;
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
