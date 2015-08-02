<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
	use HasNameTrait, HasSlugTrait, HasPublishedAtTrait;

    //
	protected $table 		= 'articles';
	protected $fillable 	= [
									'title', 
									'slug', 
									'summary', 
									'content', 
									'published_at', 
									'destinations'
								];
	protected $dates 		= ['published_at'];
	static $name_field 		= 'title';
	static $slug_field 		= 'slug';
	public $tmp_destinations= [];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new ArticleObserver);
		Static::observe(new HasNameObserver);
		Static::observe(new HasSlugObserver);
		Static::observe(new HasPublishedAtObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function destinations()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Destination', 'article_destination', 'article_id', 'destination_id');
	}

	function writer()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User', 'writer_id');
	}

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
	function scopeWriterById($q, $v = null)
	{
		if (!$v)
		{
			return $q;
		}
		else
		{
			return $q->where('writer_id', '=', $v);
		}

	}

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// FUNCTION
	// ----------------------------------------------------------------------
	static function StatusList()
	{
		return ['upcoming', 'published', 'draft'];
	}


}
