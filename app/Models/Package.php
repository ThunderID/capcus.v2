<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends BaseModel
{
	use HasNameTrait, HasSlugTrait, BelongsToManyTravelAgentsTrait; 
	//
	protected $table = 'packages';
	protected $fillable = [
							'name', 
							'slug',
							'priority', 
							'quota_headlines', 
						];
	static $name_field = 'name';
	static $slug_field = 'slug';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new PackageObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new HasSlugObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function travel_agents()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\TravelAgent')->withPivot('active_since', 'active_until');
	}

	function active_travel_agents()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\TravelAgent')->withPivot('active_since', 'active_until')
																	->wherePivot('active_since', '<', \Carbon\Carbon::now())
																	->wherePivot('active_until', '>', \Carbon\Carbon::now())
																	;
	}

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

}
