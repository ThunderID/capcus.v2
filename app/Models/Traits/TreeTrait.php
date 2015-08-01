<?php namespace App;

use Illuminate\Support\MessageBag;

trait TreeTrait {

	// ----------------------------------------------------------------------
	// RELATIONSHIP
	// ----------------------------------------------------------------------
	public function children()
	{
		return $this->hasMany(Static::getTable(), 'parent_id');
	}

	public function parent()
	{
		return $this->belongsTo(Static::getTable(), 'parent_id');
	}

	// ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
	public function scopeExceptSubtreeById($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$subtree = Category::find($v);

			if ($subtree->id)
			{
				return $q->where($this->path_field, 'not like', $subtree->ori_path_name . '%');
			}
			else
			{
				return $q;
			}

		}	
	}

	public function scopeExceptIds($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			if (!is_array($v))
			{
				$v = [$v];
			}
			return $q->whereNotIn('id', $v);
		}	
	}

	public function scopeFindPathName($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$v = str_replace("*", "%", $v);
			$v = str_replace(" ", "-", $v);
			return $q->where($this->path_field, 'like', $v);
		}
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	function getDescendantAttribute()
	{
		return Static::where($this->path_field, 'not like', $this->attributes[$this->path_field] . Static::getDelimiter() . '%');
	}

	function getPathNameAttribute()
	{
		return str_replace('-', ' ', str_replace(Static::getDelimiter(), ' > ', $this->attributes[$this->path_field]));
	}

	function getOriPathNameAttribute()
	{
		return $this->attributes[$this->path_field];
	}

	function getPathNameSlug()
	{
		return str_replace('-', ' ', str_replace(Static::getDelimiter(), ',', $this->attributes[$this->path_field]));
	}

	// ----------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------
	static function getPathField()
	{
		return Static::$path_field ? Static::$path_field : 'path';
	}

	static function getgetDelimiter()
	{
		return Static::$delimiter ? Static::$delimiter : ';;;';
	}
}
