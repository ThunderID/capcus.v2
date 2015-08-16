<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyDestinationsTrait {

	protected $destination_ids = [];

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyDestinationsTrait()
	{
		Static::observe(new BelongsToManyDestinationsObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function destinations()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Destination');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInDestinationByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destinations', function($q) use ($v) {
				$q->whereIn('destinations.id', is_array($v) ? $v : (str_is('*Collection', get_class($v)) ? $v->toArray() : [$v]));
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getDestinationIdsAttribute()
	{
		return $this->destination_ids;
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setDestinationIdsAttribute( $v )
	{
		$this->destination_ids = $v;
	}	
}
