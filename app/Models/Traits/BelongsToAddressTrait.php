<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToAddressTrait {

	protected $address_id;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToAddressTrait()
	{
		Static::observe(new BelongsToAddressObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function address()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Address');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeAddressByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destination', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}
}
