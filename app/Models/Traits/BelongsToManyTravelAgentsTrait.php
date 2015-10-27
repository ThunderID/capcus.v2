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
	function getTravelAgentIdsAttribute()
	{
		if (isset($this->travel_agent_ids))
		{
			return $this->travel_agent_ids;
		}
		else
		{
			return $this->travel_agents->lists('id')->toArray();
		}
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setTravelAgentIdsAttribute( $v )
	{
		$this->travel_agent_ids = $v;
	}
}
