<?php

namespace App;

class Subscriber extends BaseModel
{
    //
	protected $table = 'subscribers';
	protected $fillable = [
							'user_id',
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

	function scopeActive($q)
	{
		return $q->where('is_subscribe', '=', 1);
	}
}
