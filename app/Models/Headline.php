<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headline extends BaseModel
{
    //
    use HasNameTrait, HasManyImagesTrait, BelongsToTravelAgentTrait;

    //
	protected $table = 'headlines';
	protected $fillable = [
							'title', 
							'active_since',
							'active_until',
							'link_to',
							'priority'
						];
	protected $dates = ['active_since', 'active_until'];
	static $name_field = 'title';

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new HeadlineObserver);
		Static::observe(new HasManyImagesObserver);
		Static::observe(new BelongsToTravelAgentObserver);
	}

	public function scopeActiveBetween($q, \Carbon\Carbon $date1, \Carbon\Carbon $date2)
	{
		if (!$date1 && !$date2)
		{
			return $q;
		}
		else
		{
			return $q->where(function($q) use ($date1, $date2) {
                                    $q->where(function($q) use ($date1, $date2) {
    										$q->where('active_since', '<=', $date1)->where('active_until', '>=', $date1);
    									})
    								->orWhere(function($q) use ($date1, $date2) {
    										$q->where('active_since', '>=', $date1)->where('active_until', '<=', $date2);
    									})
    								->orWhere(function($q) use ($date1, $date2) {
    										$q->where('active_since', '>=', $date1)->where('active_since', '<=', $date2)->where('active_until', '>=', $date2);
	    								})
    								->orWhere(function($q) use ($date1, $date2) {
    										$q->where('active_since', '<=', $date1)->where('active_until', '>=', $date2);
    									});
                                });
		}
	}

	public function scopeActiveOn($q, \Carbon\Carbon $date1)
	{
		if (!$date1)
		{
			return $q;
		}
		else
		{
			return $q->where('active_since', '<=', $date1)
						->where('active_until', '>=', $date1);
		}
	}
}
