<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToDestinationTrait {

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToDestinationTrait()
	{
		Static::observe(new BelongsToDestinationObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function destination()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Destination');
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
			return $q->whereHas('destination', function($q) use ($v) {
				$q->whereIn('destinations.id', is_array($v) ? $v : ( $v instanceOf Collection ? $v->toArray() : [$v]));
			});
		}
	}

	function scopeInDestinationBySlug($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destination', function($q) use ($v) {
				$q->SlugIs($v);
			});
		}
	}

	function scopeInDestinationByPathAndChildren($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destination', function($q) use ($v) {
				$q->PathLike($v.'*');
			});
		}
	}

	function scopeInDestinationByPath($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destination', function($q) use ($v) {
				$q->PathLike($v);
			});
		}
	}

}
