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

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setImageIdsAttribute($v)
	{
		$this->image_ids = $v;
	}

	
}
