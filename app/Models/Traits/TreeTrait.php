<?php namespace App;

use Illuminate\Support\MessageBag;

trait TreeTrait {

	// ----------------------------------------------------------------------
	// RELATIONSHIP
	// ----------------------------------------------------------------------
	public function children()
	{
		return $this->hasMany(get_class($this), 'parent_id');
	}

	public function parent()
	{
		return $this->belongsTo(get_class($this), 'parent_id');
	}

	// ----------------------------------------------------------------------
	// SCOPE
	// ----------------------------------------------------------------------
	public function scopePathLike($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where($this->getPathField(), 'like', str_replace('*', '%', $v));
		}	
	}

	public function scopeWithSubtreeById($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$root = Static::find($v);
			if ($root->id)
			{
				return $q->pathLike($root->{Static::getPathField()} . $root->{Static::getPathField()} . '*');
			}
			else
			{
				return $q;
			}
		}	
	}


	public function scopeExceptSubtreeById($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$subtree = Static::find($v);

			if ($subtree->id)
			{
				return $q->where($this->getPathField(), 'not like', $subtree->ori_path . '%');
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

	public function scopeFindPath($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			$v = str_replace("*", "%", $v);
			$v = str_replace(" ", "-", $v);
			return $q->where($this->getPathField(), 'like', $v);
		}
	}

	// ----------------------------------------------------------------------
	// ACCESSOR
	// ----------------------------------------------------------------------
	function getDescendantAttribute()
	{
		return Static::where($this->getPathField(), 'not like', $this->attributes[$this->getPathField()] . Static::getDelimiter() . '%');
	}

	function getPathAttribute()
	{
		return str_replace('-', ' ', str_replace(Static::getDelimiter(), ' > ', $this->attributes[$this->getPathField()]));
	}

	function getOriPathAttribute()
	{
		return $this->attributes[$this->getPathField()];
	}

	function getPathSlugAttribute()
	{
		return str_replace('-', ' ', str_replace(Static::getDelimiter(), ',', $this->ori_path));
	}

	function getLevelAttribute()
	{
		return count(explode($this->getDelimiter(), $this->ori_path));
	}

	// ----------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------
	static function getPathField()
	{
		return Static::$path_field ? Static::$path_field : 'path';
	}

	static function getDelimiter()
	{
		return isset(Static::$delimiter) ? Static::$delimiter : ';;;';
	}
}
