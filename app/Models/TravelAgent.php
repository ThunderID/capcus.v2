<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelAgent extends BaseModel
{
	use HasNameTrait, HasSlugTrait; 

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
	function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'imageable');
	}

	function tours()
	{
		return $this->hasMany(__NAMESPACE__ . '\Image');
	}

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
