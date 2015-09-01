<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait,
		BelongsToDestinationTrait, HasManyImagesTrait, BelongsToManyToursTrait, BelongsToManyTagsTrait;

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
							'tag_ids'
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
	public function upcoming_tours()
	{
		return $this->belongsToMany(__NAMESPACE__  .'\Tour')->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1));
	}


	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
	public function scopeLongNameLike($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$v = str_replace('*', '%', $v);
			return $q->where('long_name', 'like', $v);
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
