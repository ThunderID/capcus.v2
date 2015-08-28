<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToTourTrait {

	protected $address_id;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToTourTrait()
	{
		Static::observe(new BelongsToTourObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function tour()
	{
		return $this->belongsTo(__NAMESPACE__  .'\Tour');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeTourByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('tour', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}
}
