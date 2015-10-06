<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Destination extends BaseModel
{
	use HasNameTrait, TreeTrait,
		BelongsToManyArticlesTrait, HasManyImagesTrait, HasManyPlacesTrait,  BelongsToManyToursTrait;

    //
	protected $table = 'destinations';
	protected $fillable = [
							'name', 
							'parent_id'
						];
	static $name_field = 'name';
	static $slug_field = 'slug';
	static $path_field = 'path';
	protected $appends = ['long_name'];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new DestinationObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new TreeObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
	function scopeTopDestination($q, \Carbon\Carbon $date1, \Carbon\Carbon $date2)
	{
		if (!$date1 && !$date2)
		{
			return $q;
		}
		else
		{
			return $q->join('destination_tour', 'destination_id', '=', 'destinations.id')
					->join('tours', 'tours.id', '=', 'tour_id')
					->join('tour_schedules as ts', 'ts.tour_id', '=' ,'tours.id')
					->addselect(DB::raw('destinations.*, count(ts.id) as tour_schedule_count'))
					->groupBy('destinations.id')
					->orderBy('tour_schedule_count', 'desc');
		}
	}

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------
	public function getLongNameAttribute()
	{
		$tmp = explode($this->getDelimiter(), $this->ori_path);
		krsort($tmp);

		$name = '';
		foreach ($tmp as $k => $x)
		{
			if ($name)
			{
				$name.=', ';
			}
			$name .= $x;
		}

		return ucwords(str_replace('-', ' ', $name));
	}

	function getTotalUpcomingSchedulesAttribute()
	{
		// calculate this destination total schedules
		$total_schedule = 0;
		foreach ($this->tours as $tour)
		{
			$total_schedule += $tour->schedules->count();
		}

		// calculate this destination and its children total schedules
		$descendats = $this->descendant;
		$descendats->load('tours', 'tours.schedules');
		foreach ($descendants as $descendant)
		{
			foreach ($descendant->tours as $tour)
			{
				$total_schedule += $tour->schedules->count();
			}			
		}


		return $total_schedule;
	}

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
	
}
