<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyToursTrait {

	protected $tour_ids;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyToursTrait()
	{
		Static::observe(new BelongsToManyToursObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function tours()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Tour');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInTourByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('tours', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getTourIdsAttribute()
	{
		if (isset($this->tour_ids))
		{
			return $this->tour_ids;
		}
		else
		{
			return $this->tours->lists('id')->toArray();
		}
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setTourIdsAttribute( $v )
	{
		$this->tour_ids = $v;
	}	
}
