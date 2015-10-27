<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyTourOptionsTrait {

	protected $option_ids;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyTourOptionsTrait()
	{
		Static::observe(new BelongsToManyTourOptionsObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function options()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\TourOption')->withPivot('description');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInOptionByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('options', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getOptionIdsAttribute()
	{
		if (isset($this->option_ids))
		{
			return $this->option_ids;
		}
		else
		{
			return $this->options->lists('id')->toArray();
		}
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setOptionIdsAttribute( $v )
	{
		$this->option_ids = $v;
	}
}
