<?php

namespace App\Models;

use App\Patterns\State\Request\RequestStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Request extends Model {

	use HasFactory;

	public RequestStatus $status;

	protected $casts = [
		'status' => RequestStatus::class,
	];

	protected $appends = [
		'can_update'
	];

	public function user():BelongsTo{
		return $this->belongsTo(User::class); // select * from users where id=? LIMIT 1;
	}

	public function offer():MorphTo{
		return $this->morphTo();
	}

	public function comments():HasMany{
		return $this->hasMany(Comment::class);
	}

	public function documentationFiles():HasMany{
		return $this->hasMany(DocumentationFile::class);
	}

	public function canUpdate():Attribute{
		return Attribute::make(function (){
			return $this->status->canUpdate();
		});
	}

}
