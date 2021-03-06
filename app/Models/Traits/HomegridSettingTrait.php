<?php

namespace App;

trait HomegridSettingTrait {

	protected $tag_detail;

    public static function bootHomegridSettingTrait()
    {
        static::addGlobalScope(new HomegridSettingScope);
        static::observe(new HomegridObserver);
    }


    // ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
    public function scopeHomegrid($q, $id = null)
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
	public function setTypeAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->type = $v;
		$this->attributes['value'] = json_encode($value);
	}

	//destination & featured destination
	public function setTitleAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->title = $v;
		$this->attributes['value'] = json_encode($value);
	}

	public function setDestinationAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->destination = $v;
		$this->attributes['value'] = json_encode($value);
	}

	public function setImageUrlAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->image_url = $v;
		$this->attributes['value'] = json_encode($value);
	}

	public function setLabelAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->label = $v;
		$this->attributes['value'] = json_encode($value);
	}

	public function setShowTitleAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->show_title = ($v ? true : false);
		$this->attributes['value'] = json_encode($value);
	}

	// TAG
	public function setTagAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->tag = $v;
		$this->attributes['value'] = json_encode($value);
	}

	// TAG
	public function setTagDetailAttribute($v)
	{
		$this->tag_detail = $v;
	}

	public function setLinkAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->link = $v;
		$this->attributes['value'] = json_encode($value);
	}


	//script
	public function setScriptAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		$value->script = $v;
		$this->attributes['value'] = json_encode($value);
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	public function getTypeAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->type;
	}

	//destination & featured destination
	public function getTitleAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->title;
	}

	public function getShowTitleAttribute($v)
	{
		$value = json_decode($this->attributes['value']);
		return $value->show_title;
	}

	public function getDestinationAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->destination;
	}

	public function getDestinationDetailAttribute()
	{
		if (!$this->attributes['destination_detail'])
		{
			$destination_id = $this->destination;
			$tmp 	= \App\Destination::find($destination_id);
			$this->attributes['destination_detail'] = $tmp;
		}
		return $this->attributes['destination_detail'];
	}

	public function getImageUrlAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->image_url;
	}

	public function getLabelAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->label;
	}

	public function getLinkAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->link;
	}

	// tag
	public function getTagAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->tag;
	}

	public function getTagDetailAttribute()
	{
		if (!$this->tag_detail)
		{
			$tag_id = $this->tag;
			if ($tag_id)
			{
				$tmp 	= \App\Tag::find($tag_id);
				if ($tmp)
				{
					$this->tag_detail = $tmp;
				}
				else
				{
					$this->tag_detail = new \App\Tag;
				}
			}
		}
		return $this->tag_detail;
	}

	//script
	public function getScriptAttribute()
	{
		$value = json_decode($this->attributes['value']);
		return $value->script;
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	static public function getType()
	{
		// return ['destination', 'featured_destination', 'script', 'place', 'article', 'blog'];
		return ['destination', 'tour_tags', 'link'];
	}
}