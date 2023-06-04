<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model {

	use HasFactory;

	protected $fillable = [
		'user_id',
		'text'
	];

	public function application():BelongsTo{
		return $this->belongsTo(Application::class);
	}

	public function user():BelongsTo{
		return $this->belongsTo(User::class)->select([
			'id',
			'first_name',
			'middle_name',
			'last_name',
		]);
	}

}
