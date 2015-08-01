<?php namespace App;

use Illuminate\Support\MessageBag;

trait ExceptIdTrait {
	
	public function scopeExceptId($q, $v = null)
	{
		if (is_null($v))
		{
			return $q;
		}
		else
		{
			return $q->whereNotIn('id', is_array($v) ? $v : [$v]);
		}
	}
}

