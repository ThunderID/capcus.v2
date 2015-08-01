<?php namespace App;

use Illuminate\Support\MessageBag;

trait HasNameTrait {

	//
	protected function scopeNameLike($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$v = str_replace('*', '%', $v);
			return $q->where(Static::getNameField(), 'like', $v);
		}
	}

	public static function getNameField()
	{
		return Static::$name_field ? Static::$name_field : 'name';
	}
	
}
