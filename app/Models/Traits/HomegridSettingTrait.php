<?php

namespace App;

trait HomegridSettingTrait {

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootHomegridSettingTrait()
    {
        static::addGlobalScope(new HomegridSettingScope);
        static::observe(new HomegridObserver);
    }


    // ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
    function scopeHomegrid($q, $id = null)
	{
		if (!$id)
		{
			return $q->where('name', 'like', 'homegrid_%');
		}
		else
		{
			return $q->where('name', 'like', 'homegrid_'. $id);
		}
	}

	// ----------------------------------------------------------------------
	// MUTATOR
	// ----------------------------------------------------------------------
	function setTypeAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->type = $v;
		$this->attributes['value'] = json_encode($value);
	}

	//destination & featured destination
	function setTitleAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->title = $v;
		$this->attributes['value'] = json_encode($value);
	}

	function setDestinationAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->destination = $v;
		$this->attributes['value'] = json_encode($value);
	}

	function setImageUrlAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->image_url = $v;
		$this->attributes['value'] = json_encode($value);
	}

	function setIsFeaturedAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->is_featured = $v;
		$this->attributes['value'] = json_encode($value);
	}

	// TAG
	function setTagAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->tag = $v;
		$this->attributes['value'] = json_encode($value);
	}


	//script
	function setScriptAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->script = $v;
		$this->attributes['value'] = json_encode($value);
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	function getTypeAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->type;
	}

	//destination & featured destination
	function getTitleAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->title;
	}

	function getDestinationAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->destination;
	}

	function getDestinationDetailAttribute()
	{
		if (!$this->attributes['destination_detail'])
		{
			$destination_id = $this->destination;
			$tmp 	= \App\Destination::find($destination_id);
			$this->attributes['destination_detail'] = $tmp;
		}
		return $this->attributes['destination_detail'];
	}

	function getImageUrlAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->image_url;
	}

	function getIsFeaturedAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->is_featured;
	}

	// tag
	function getTagAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->tag;
	}

	function getTagDetailAttribute()
	{
		if (!$this->attributes['tag_detail'])
		{
			$tag_id = $this->tag;
			$tmp 	= \App\Tag::find($tag_id);
			$this->attributes['tag_detail'] = $tmp;
		}
		return $this->attributes['tag_detail'];
	}

	//script
	function getScriptAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->script;
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	static function getType()
	{
		// return ['destination', 'featured_destination', 'script', 'place', 'article', 'blog'];
		return ['destination', 'tour_tags'];
	}
}