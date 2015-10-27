<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyTagsTrait {

	protected $tag_ids;

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

	function scopeInTagByTag($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('tags', function($q) use ($v) {
				$q->whereIn('tags.tag', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getTagIdsAttribute()
	{
		if (isset($this->tag_ids))
		{
			return $this->tag_ids;
		}
		else
		{
			return $this->tags->lists('id')->toArray();
		}
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setTagIdsAttribute( $v )
	{
		$this->tag_ids = $v;
	}	
}
