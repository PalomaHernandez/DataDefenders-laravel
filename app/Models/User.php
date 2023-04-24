<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

	protected $appends = [
		'full_name',
		'full_name_reversed',
	];

	public function requests():HasMany{
		return $this->hasMany(Request::class);
	}

	public function fullName():Attribute{
		return Attribute::make(function (){
			return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
		});
	}

	public function fullNameReversed():Attribute{
		return Attribute::make(function (){
			return $this->last_name.', '.$this->first_name.' '.$this->middle_name;
		});
	}

}
