<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends BaseModel
{
	use HasNameTrait, BelongsToManyDestinationsTrait, BelongsToManyPlacesTrait, BelongsToManyArticlesTrait, BelongsToManyToursTrait; 
    //
	protected $table = 'tags';
	protected $fillable = [
							'tag', 
						];
	static $name_field = 'tag';
	public $timestamps = false;

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new TagObserver);
		Static::observe(new HasNameObserver);
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
	function getTotalUpcomingSchedulesAttribute()
	{
		$total_schedule = 0;
		$this->load('tours', 'tours.schedules');
		foreach ($this->tours as $tour)
		{
			$total_schedule += $tour->schedules->count();
		}

		return $total_schedule;
	}
}
