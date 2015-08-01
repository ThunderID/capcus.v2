<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends BaseModel
{
	use HasNameTrait, HasSlugTrait, TreeTrait;

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
	function tours()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Tour', 'visits', 'destination_id', 'tour_id');
	}

	function articles()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Article', 'article_destination', 'destination_id', 'article_id');
	}

	function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'imageable');
	}

	function directories()
	{
		return $this->morphMany(__NAMESPACE__ . '\Directory');
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
	// FUNCTIONS
	// ----------------------------------------------------------------------

}
