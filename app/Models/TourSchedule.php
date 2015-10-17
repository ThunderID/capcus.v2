<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;

class TourSchedule extends BaseModel
{
	use BelongsToTourTrait;

	//
	protected $table = 'tour_schedules';
	protected $fillable = [
							'departure', 
							'departure_until', 
							'currency', 
							'views',
							'original_price', 
							'discounted_price', 
							'tour_id',
							'min_person'
						];
	protected $dates = ['departure', 'departure_until', 'published_at'];

	// ----------------------------------------------------------------------
	// BOOT
	// ----------------------------------------------------------------------
	static function boot()
	{
		parent::boot();
		Static::observe(new TourScheduleObserver);
	}

	// ----------------------------------------------------------------------
	// RELATIONS
	// ----------------------------------------------------------------------
	

	// ----------------------------------------------------------------------
	// SCOPES
	// ----------------------------------------------------------------------
	function scopeScheduledBetween($q, \Carbon\Carbon $date1 = null, \Carbon\Carbon $date2 = null)
	{
		if (!$date1 && !$date2)
		{
			return $q;
		}
		elseif (!$date1 || !$date2)
		{
			throw new Exception("Invalid date range", 1);
		}
		else
		{
			if ($date2->lt($date1))
			{
				$tmp = $date1;
				$date1 = $date2;
				$date2 = $tmp;
			}
			
			return $q->where(function($q) use ($date1, $date2) { 
						$q->where(function($q) use ($date1, $date2) {
									$q->whereNull('departure_until')
										->where('departure', '>=', $date1)
										->where('departure', '<=', $date2);
								})
						->orWhere(function($q) use ($date1, $date2) {
									$q->whereNotNull('departure_until')
										->where(function($q) use ($date1, $date2)  { 
											$q->where(function($q) use ($date1, $date2) {
												$q->where('departure', '<=', $date1)->where('departure_until', '>=', $date1);
											})
											->orWhere(function($q) use ($date1, $date2) {
													$q->where('departure', '>', $date1)->where('departure_until', '<=', $date2);
												})
											->orWhere(function($q) use ($date1, $date2) {
													$q->where('departure', '>', $date1)->where('departure', '<=', $date2)->where('departure_until', '>=', $date2);
												})
											->orWhere(function($q) use ($date1, $date2) {
													$q->where('departure', '<=', $date1)->where('departure_until', '>=', $date2);
												});
										});
								});
					});
		}
	}


	public function scopeBudgetBetween($q, $budget1 = null, $budget2 = null)
	{
		if (is_null($budget1) || is_null($budget2))
		{
			return $q;
		}
		elseif (is_null($budget1) || is_null($budget2))
		{
			throw new Exception("Invalid budget range", 1);
		}
		else
		{
			if ($budget2 < $budget1)
			{
				$tmp = $budget1;
				$budget1 = $budget2;
				$budget2 = $tmp;
			}
			
			if (!is_numeric($budget1))
			{
				throw new Exception("Min budget must be numeric", 1);
			}
			if (!is_numeric($budget2))
			{
				throw new Exception("Max budget must be numeric", 1);
			}

			return $q->where('discounted_price', '>=', $budget1)->where('discounted_price', '<=', $budget2);
		}
	}

	public function scopePromo($q)
	{
		return $q->whereRaw('`discounted_price` < `original_price`');
	}

	public function scopePublished($q)
	{
		return $q->with(['tour' => function($q) {
			$q->published();
		}]);
	}

	function ScopeInTagByIds($q, $id)
	{
		if (!$id)
		{
			return $q;
		}
		else
		{
			return $q->join('tours', 'tours.id', '=', 'tour_schedules.tour_id')
					->join('tag_tour', 'tag_tour.tour_id', '=', 'tours.id')
					->join('tags', 'tags.id', '=', 'tag_tour.tag_id')
					->whereIn('tags.id', (is_array($id) ? $id : [$id]));
		}
	}

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
