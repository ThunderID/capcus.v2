<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyTagsTrait {

	protected $tag_ids = [];

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyTagsTrait()
	{
		Static::observe(new BelongsToManyTagsObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function tags()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Tag');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInTagByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('tags', function($q) use ($v) {
				$q->whereIn('tags.id', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getTagIdsAttribute()
	{
		return $this->tag_ids;
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setTagIdsAttribute( $v )
	{
		$this->tag_ids = $v;
	}	
}
