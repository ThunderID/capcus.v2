<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword, HasNameTrait, SoftDeletes;


	protected $table = 'users';
	protected $fillable = [
							'name', 
							'email', 
							'password', 
							'is_admin', 
							'sso_twitter_id', 
							'sso_twitter_data', 
							'sso_twitter_updated_at', 
							'sso_facebook_id', 
							'sso_facebook_data', 
							'sso_facebook_updated_at', 
							'avatar', 
							'dob', 
							'telp', 
							'gender'
						];
	protected $hidden 	= ['password', 'remember_token',];
	protected $dates 	= ['sso_twitter_updated_at', 'sso_facebook_updated_at', 'dob', 'deleted_at'];
	protected $appends	= ['is_complete'];

	static $name_field = 'name';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new UserObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	public function love()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Tour', 'love_tours');
	}

	// ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
	public function scopeFindName($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$v = str_replace('*', '%', $v);
			return $q->where('name', 'like', $v);
		}
	}

	public function scopeFindEmail($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('email', 'like', $v);
		}
	}

	public function scopeIsAdmin($q, $v = null)
	{
		if (is_null($v))
		{
			return $q;
		}
		else
		{
			return $q->where('is_admin', '=', ($v ? 1 : 0));
		}
	}

	public function scopeTwitterId($q, $v = null)
	{
		if (is_null($v))
		{
			return $q;
		}
		else
		{
			return $q->where('sso_twitter_id', '=', $v);
		}
	}

	public function scopeFacebookId($q, $v = null)
	{
		if (is_null($v))
		{
			return $q;
		}
		else
		{
			return $q->where('sso_facebook_id', '=', $v);
		}
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	public function getIsCompleteAttribute()
	{
		if ($this->attributes['email'] && $this->attributes['dob'] && $this->attributes['gender'])
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

	// ----------------------------------------------------------------------
	// MUTATOR
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
}
