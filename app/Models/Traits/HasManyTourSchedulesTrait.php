<?php namespace App;

use Illuminate\Support\MessageBag;

trait HasManyTourSchedulesTrait {

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootHasManyTourSchedulesTrait()
	{
		// Static::observe(new BelongsToManyTourOptionsObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function schedules()
	{
		return $this->hasMany(__NAMESPACE__ . '\TourSchedule');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getScheduleIdsAttribute()
	{
		return $this->schedule_ids;
	}
	
	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setScheduleIdsAttribute( $v )
	{
		$this->schedule_ids = $v;
	}

}
