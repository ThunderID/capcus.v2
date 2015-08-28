<?php namespace App;

use Illuminate\Support\MessageBag;

trait HasSlugTrait {

	//
	function scopeSlugIs($q, $v)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where(Static::getSlugField(), 'like', $v);
		}
	}

	public static function getSlugField()
	{
		return Static::$slug_field ? Static::$slug_field : 'slug';
	}
	
}
