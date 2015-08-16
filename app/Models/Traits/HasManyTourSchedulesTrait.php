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
	public function scopeScheduledBetween($q, \Carbon\Carbon $date1 = null, \Carbon\Carbon $date2 = null)
	{
		return $q->whereHas('schedules', function($q) use ($date1, $date2) {
			$q->scheduledBetween($date1, $date2);
		});
	}

	public function scopeBudgetBetween($q, $budget1 = null, $budget2 = null)
	{
		return $q->whereHas('schedules', function($q) use ($budget1, $budget2) {
				$q->budgetBetween($budget1, $budget2);
		});
	}
	

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	
	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
}
