<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends BaseModel
{
	use HasNameTrait, HasSlugTrait, TreeTrait,
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

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
}
