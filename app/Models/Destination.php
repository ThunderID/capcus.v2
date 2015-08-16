<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends BaseModel
{
	use HasNameTrait, HasSlugTrait, TreeTrait,
		BelongsToManyArticlesTrait, HasManyImagesTrait, HasManyPlacesTrait,  BelongsToManyToursTrait;

    //
	protected $table = 'destinations';
	protected $fillable = [
							'name', 
							'parent_id'
						];
	static $name_field = 'name';
	static $slug_field = 'slug';
	static $path_field = 'path';
	protected $appends = ['long_name'];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new DestinationObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new TreeObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------
	public function getLongNameAttribute()
	{
		$tmp = explode($this->getDelimiter(), $this->ori_path);
		krsort($tmp);

		$name = '';
		foreach ($tmp as $k => $x)
		{
			if ($name)
			{
				$name.=', ';
			}
			$name .= $x;
		}

		return ucwords(str_replace('-', ' ', $name));
	}

	// ----------------------------------------------------------------------
	// FUNCTIONS
	// ----------------------------------------------------------------------
}
