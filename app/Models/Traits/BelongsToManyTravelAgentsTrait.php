<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyTravelAgentsTrait {

	protected $travel_agent_ids = [];

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyTravelAgentsTrait()
	{
		Static::observe(new BelongsToManyTravelAgentsObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function travel_agents()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\TravelAgent');
	}


	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInTravelAgentByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('travel_agents', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getOptionIdsAttribute()
	{
		return $this->travel_agent_ids;
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setOptionIdsAttribute( $v )
	{
		$this->travel_agent_ids = $v;
	}
}
