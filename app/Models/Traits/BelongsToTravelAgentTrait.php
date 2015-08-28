<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToTravelAgentTrait {

	protected $travel_agent_id;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToTravelAgentTrait()
	{
		Static::observe(new BelongsToTravelAgentObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function travel_agent()
	{
		return $this->belongsTo(__NAMESPACE__ . '\TravelAgent');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeTravelAgentByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('travel_agent', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}
}
