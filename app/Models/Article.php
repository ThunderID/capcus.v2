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
								];
	protected $dates 		= ['published_at'];
	protected $name_field 	= 'title';

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

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// MUTATORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

	// ----------------------------------------------------------------------
	// ACCESSORS
	// ----------------------------------------------------------------------

}
