<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelAgent extends BaseModel
{
	use HasNameTrait, HasSlugTrait,
		HasManyImagesTrait, HasManyToursTrait, BelongsToManyPackagesTrait;

    //
	protected $table = 'travel_agencies';
	protected $fillable = [
							'name', 
							'email', 
							'slug', 
							'address',
							'phone'
						];

	static $name_field	= 'name';
	static $slug_field	= 'slug';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new TravelAgentObserver);
		Static::observe(new HasNameObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	// function addresses()
	// {
	// 	return $this->morphMany(__NAMESPACE__ . '\Address', 'location');
	// }

	// function phones()
	// {
	// 	return $this->morphMany(__NAMESPACE__ . '\Phone', 'phoneable');
	// }
	
	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------
	static function latestTour($skip, $limit = 10)
	{
		// return TravelAgent::with('images')
		// 		->join('tours', 'tours.travel_agent_id', '=', 'travel_agencies.id')
		// 		->join('tour_schedules', 'tour_schedules.tour_id', '=', 'tours.id')
		// 		->where('tour_schedules.departure', '>', \Carbon\Carbon::now())
		// 		->whereNotNull('tours.published_at')
		// 		->where('tours.published_at', '<=', \Carbon\Carbon::now())
		// 		->latest('tours.created_at')
		// 		->skip(max(0, $skip))
		// 		->take(max(1, min(10, $limit)));


	}

}
