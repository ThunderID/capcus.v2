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
	function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'imageable');
	}

	function destination()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Destination');
	}

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
	function scopeInDestinationById($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('destination', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}

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
