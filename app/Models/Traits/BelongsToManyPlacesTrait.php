<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyPlacesTrait {

	protected $place_ids = [];

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyPlacesTrait()
	{
		Static::observe(new BelongsToManyPlacesObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function places()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Place');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInPlaceByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('places', function($q) use ($v) {
				$q->whereIn('places.id', is_array($v) ? $v : [$v]);
			});
		}
	}

	function scopeInPlaceBySlug($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('places', function($q) use ($v) {
				$q->whereIn('places.slug', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getPlaceIdsAttribute()
	{
		return $this->place_ids;
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setPlaceIdsAttribute( $v )
	{
		$this->place_ids = $v;
	}	
}
