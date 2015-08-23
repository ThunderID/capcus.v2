<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    //
	protected $table = 'subscribers';
	protected $fillable = [
							'email', 
							'is_subscribe', 
						];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new SubscriberObserver);
	}

	// ------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------
	function user()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User');
	}

	// ------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------
	function scopeFindEmail($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where("email", "like", $v);
		}
	}
}
