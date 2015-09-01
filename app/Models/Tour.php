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
		$this->cheapest = $this->schedules->sortBy('discounted_price')->first();
		return $this->cheapest;
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
