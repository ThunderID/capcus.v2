<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait, 
		BelongsToManyDestinationsTrait, BelongsToManyPlacesTrait, BelongsToManyTourOptionsTrait, HasManyTourSchedulesTrait, BelongsToTravelAgentTrait;

    //
	protected $table = 'tours';
	protected $fillable = [
							'name', 
							'slug', 
							'ittinary', 
							'summary', 
							'duration_day', 
							'duration_night',
							'published_at', 
						];
	protected $dates = ['published_at'];
	static $name_field = 'name';
	static $slug_field = 'slug';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new TourObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new HasSlugObserver);
		Static::observe(new HasPublishedAtObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------
	function getCheapestAttribute()
	{
		if ($this->schedules->count() > 0)
		{
			foreach ($this->schedules as $schedule)
			{
				if (!$cheapest)
				{
					$cheapest = $schedule;
				}

				if ($cheapest->discounted_price > $schedule->discounted_price)
				{
					$cheapest = $schedule;
				}
				elseif (($cheapest->discounted_price == $schedule->discounted_price) && ($cheapest->id != $schedule->id))
				{
					$cheapest = null;
					break;
				}
			}
		}

		return $cheapest;
	}

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------
}
