<?php namespace App;

use Illuminate\Support\MessageBag;

trait HasManyImagesTrait {

	protected $image_ids;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootHasManyImagesTrait()
	{

	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function images()
	{
		return $this->morphMany(__NAMESPACE__ . '\Image', 'imageable');
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getImageIdsAttribute()
	{
		return $this->image_ids;
	}

	function getSmallImageAttribute()
	{
		return $this->images->where('name','SmallImage')->first()->path;
	}

	function getLargeImageAttribute()
	{
		return $this->images->where('name','LargeImage')->first()->path;
	}

	function getImageGalleryAttribute()
	{
		foreach ($this->images as $image)
		{
			if (str_is('gallery*', strtolower($image->name)))
			{
				$galleries[] = $image;
			}
		}
		return $galleries;
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setImageIdsAttribute($v)
	{
		$this->image_ids = $v;
	}

	
}
