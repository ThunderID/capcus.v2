<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait;

    //
	protected $table = 'places';
	protected $fillable = [
							'name', 
							'slug', 
							'summary', 
							'description', 
							'longitude', 
							'latitude', 
							'published_at', 
						];
	protected $dates = ['published_at'];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new DirectoryObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new HasSlugObserver);
		Static::observe(new HasPublishedAtObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'imageable');
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
