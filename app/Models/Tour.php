<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait, 
		BelongsToManyDestinationsTrait, BelongsToManyPlacesTrait, BelongsToManyTourOptionsTrait, HasManyTourSchedulesTrait, BelongsToTravelAgentTrait, HasManyImagesTrait, BelongsToManyTagsTrait;

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
							'destination_ids', 
							'tag_ids', 
							'place_ids',
							'travel_agent_id',
							'option_ids',
							'image_ids'
						];
	protected $dates = ['published_at'];
	static $name_field = 'name';
	static $slug_field = 'slug';

	protected $cheapest;

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
		if ($this->schedules->count() == 1)
		{
			return $this->schedules->first();
		}
		elseif ($this->schedules->sortBy('discounted_price')->first()->discounted_price < $this->schedules->sortBy('discounted_price')[1]->discounted_price)
		{
			return $this->schedules->sortBy('discounted_price')->first();
		}
		else
		{
			return null;
		}
	}

	function getSmallImageAttribute()
	{
		if ($this->images->where('name','SmallImage')->first()->path)
		{
			return $this->images->where('name','SmallImage')->first()->path;
		}
		elseif ($this->places->count() && $this->places->first()->images->where('name', 'SmallImage')->first()->path)
		{
			return $this->places->first()->images->where('name', 'SmallImage')->first()->path;
		}
		else
		{
			return null;
		}
	}

	function getLargeImageAttribute()
	{
		if ($this->images->where('name','LargeImage')->first()->path)
		{
			return $this->images->where('name','LargeImage')->first()->path;
		}
		elseif ($this->places->count() && $this->places->first()->images->where('name', 'LargeImage')->first()->path)
		{
			return $this->places->first()->images->where('name', 'LargeImage')->first()->path;
		}
		else
		{
			return null;
		}
	}

	// ----------------------------------------------------------------------
	// 
	// ----------------------------------------------------------------------
	static public function ByPriorityTravelAgent($limit = 10)
	{
		return Static::join('travel_agencies', 'travel_agencies.id', '=', 'tours.travel_agent_id')
						->join('package_travel_agent', 'package_travel_agent.travel_agent_id', '=', 'travel_agencies.id')
						->join('packages', function($join) { 
							$join->on('packages.id', '=', 'package_travel_agent.package_id')
								->where('active_since', '<=', \Carbon\Carbon::now())
								->where('active_until', '>=', \Carbon\Carbon::now());
							})
						->whereHas('schedules', function($q){
							$q->where('departure', '>=', \Carbon\Carbon::now());
						})
						->select('tours.*')
						->orderBy('packages.priority', 'desc')
						->limit($limit)
						->get();
	}
}
