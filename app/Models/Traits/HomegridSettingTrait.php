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
		$destination_id = $this->destination;
		$tmp 	= \App\Destination::find($destination_id);
		return $tmp;
	}

	function getImageUrlAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->image_url;
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
		return ['destination', 'featured_destination', 'script'];
	}
}