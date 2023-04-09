<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

	use HasApiTokens, HasFactory, Notifiable;

	protected $fillable = [
		'first_name',
		'middle_name',
		'last_name',
		'email',
		'password',
		'phone',
		'address_line_1',
		'address_line_2',
		'city',
		'region',
		'country',
		'postal_code',
		'id_card',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function requests():HasMany{
		return $this->hasMany(Request::class);
	}

}
