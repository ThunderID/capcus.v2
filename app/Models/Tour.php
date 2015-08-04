<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait;

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
							'travel_agent_id',
							'destination_ids',
							'place_ids',
							'schedule_ids',
							'option_ids'
						];
	protected $dates = ['published_at'];
	static $name_field = 'name';
	static $slug_field = 'slug';
	protected $destination_ids = [];
	protected $schedule_ids = [];
	protected $place_ids = [];
	protected $option_ids = [];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new TourObserver);
		Static::observe(new BelongsToTravelAgentObserver);
		Static::observe(new BelongsToManyPlacesObserver);
		Static::observe(new BelongsToManyDestinationsObserver);
		Static::observe(new BelongsToManyTourOptionsObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new HasSlugObserver);
		Static::observe(new HasPublishedAtObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function destinations()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Destination', 'destination_tour', 'tour_id', 'destination_id');
	}

	function places()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Place', 'place_tour', 'tour_id', 'place_id');
	}

	function schedules()
	{
		return $this->hasMany(__NAMESPACE__ . '\TourSchedule');
	}

	function travel_agent()
	{
		return $this->belongsTo(__NAMESPACE__ . '\TravelAgent');
	}

	function options()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\TourOption', 'contain_options', 'tour_id', 'tour_option_id')->withPivot('description');
	}

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
	function scopeInDestinationById($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destination', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}

	function scopeTravelAgentById($q, $v = null)
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


	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------
	function setDestinationIdsAttribute( $v )
	{
		$this->destination_ids = $v;
	}

	function setPlaceIdsAttribute( $v )
	{
		$this->place_ids = $v;
	}

	function setScheduleIdsAttribute( $v )
	{
		$this->schedule_ids = $v;
	}

	function setOptionIdsAttribute( $v )
	{
		$this->option_ids = $v;
	}

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------
	function getDestinationIdsAttribute()
	{
		return $this->destination_ids;
	}

	function getPlaceIdsAttribute()
	{
		return $this->place_ids;
	}

	function getScheduleIdsAttribute()
	{
		return $this->schedule_ids;
	}

	function getOptionIdsAttribute()
	{
		return $this->option_ids;
	}


	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

}
