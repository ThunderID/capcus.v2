<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelAgent extends BaseModel
{
	use HasNameTrait, HasSlugTrait,
		HasManyImagesTrait, HasManyAddressesTrait, HasManyToursTrait, BelongsToManyPackagesTrait;

    //
	protected $table = 'travel_agencies';
	protected $fillable = [
							'name', 
							'email', 
							'slug', 
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
		Static::observe(new HasSlugObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function addresses()
	{
		return $this->morphMany(__NAMESPACE__ . '\Address', 'location');
	}

	function phones()
	{
		return $this->morphMany(__NAMESPACE__ . '\Phone', 'phoneable');
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

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

}
