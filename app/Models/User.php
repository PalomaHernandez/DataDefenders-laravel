<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\Database\Concerns\HasRoles;

class User extends Authenticatable {

	use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
		'password_recovery_token',
		'password_recovery_expires_at',
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

	public function applications():HasMany{
		return $this->hasMany(Application::class);
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
