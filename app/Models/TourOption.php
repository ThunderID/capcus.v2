<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourOption extends BaseModel
{
    use HasNameTrait;

    //
	protected $table = 'tour_options';
	protected $fillable = [
							'name', 
						];
	public $timestamps = false;
	protected $dates = ['published_at'];
	static $name_field = 'name';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new TourOptionObserver);
		Static::observe(new HasNameObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	function tours()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Tour')->withPivot('description');
	}



}
