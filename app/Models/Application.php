<?php

namespace App\Models;

use App\Contracts\Offer;
use App\Patterns\State\Request\ApplicationStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property-read Offer $offer
 */
class Application extends Model {

	use HasFactory;

	protected $fillable = [
		'status',
		'user_id',
		'major_id',
		'payment_url',
	];

	protected $casts = [
		'status' => ApplicationStatus::class,
	];

	protected $appends = [
		'can_update',
		'is_job',
		'is_scholarship',
	];

	public function user():BelongsTo{
		return $this->belongsTo(User::class);
	}

	public function offer():MorphTo{
		return $this->morphTo();
	}

	public function comments():HasMany{
		return $this->hasMany(Comment::class)->latest();
	}

	public function documentationFiles():HasMany{
		return $this->hasMany(DocumentationFile::class)->latest();
	}

	public function canUpdate():Attribute{
		return Attribute::make(function (){
			return $this->status->canUpdate();
		});
	}

	public function cannotUpdate():Attribute{
		return Attribute::make(function (){
			return !$this->status->canUpdate();
		});
	}

	public function isPending():Attribute{
		return Attribute::make(function (){
			return $this->status === ApplicationStatus::Pending;
		});
	}

	public function needsDocumentation():Attribute{
		return Attribute::make(function (){
			return $this->status === ApplicationStatus::Documentation;
		});
	}

	public function isRejected():Attribute{
		return Attribute::make(function (){
			return $this->status === ApplicationStatus::Rejected;
		});
	}

	public function isAccepted():Attribute{
		return Attribute::make(function (){
			return $this->status === ApplicationStatus::Accepted;
		});
	}

	public function isJob():Attribute{
		return Attribute::make(function (){
			return $this->offer->isJobOffer;
		});
	}

	public function isScholarship():Attribute{
		return Attribute::make(function (){
			return $this->offer->isScholarshipOffer;
		});
	}

}
