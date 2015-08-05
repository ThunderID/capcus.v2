<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait
		BelongsToDestinationTrait, HasManyImagesTrait;

    //
	protected $table = 'places';
	protected $fillable = [
							'name', 
							'slug', 
							'summary', 
							'content', 
							'longitude', 
							'latitude', 
							'published_at', 
							'destination_id', 
						];
	protected $dates = ['published_at'];
	static $name_field = 'name';
	static $slug_field = 'slug';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new PlaceObserver);
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

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

}
