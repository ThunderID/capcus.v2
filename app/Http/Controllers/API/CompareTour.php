<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;

use Auth, Route, Input, Response, Session, \Illuminate\Support\Collection;
use \App\User, \App\Tour;

class CompareTour extends Controller {

	public function add()
	{
		$ids = Session::get('compare_cart');
		foreach ($ids as $k => $v)
		{
			if (is_null($v))
			{
				unset($ids[$k]);
			}
		}


		if (Input::has('id'))
		{
			// FIND TOUR SCHEDULE
			$tour_schedule = \App\TourSchedule::find(Input::get('id'));

			if (!$tour_schedule)
			{
				return Response::json(['Invalid Request'], 403);
			}
			else
			{
				if (!is_array($ids) && !is_null($ids))
				{
					$ids = [$ids];
				}
				else
				{
					$ids = [];
				}
				$ids = array_merge($ids, [Input::get('id') * 1]);
				$ids = array_unique($ids);
				if (count($ids) > 4)
				{
					return Response::json(['error' => 'Jumlah maksimal tour yang dapat dibandingkan adalah 4 tour'], 200);
				}
				Session::put('compare_cart', $ids);
			}
		}

		// Find TourSchedules
		if (!empty($ids))
		{
			$tour_schedules = \App\TourSchedule::with('tour', 
														'tour.travel_agent', 'tour.travel_agent.images'
													)
										->whereIn('id', $ids)
										->published()
										->orderBy('departure')
										->get();
		}
		else
		{
			$tour_schedules = new Collection;
		}


		return Response::json(['data' => $tour_schedules->toArray()], 200);
	}

	public function remove()
	{
		$ids = Session::get('compare_cart');
		if (Input::has('id'))
		{
			$remove_id = Input::get('id');
			$ids = array_where($ids, function($k, $v) use ($remove_id) { 
				return $v != $remove_id;
			});
			Session::put('compare_cart', $ids);
		}

		// Find TourSchedules
		if (!empty($ids))
		{
			$tour_schedules = \App\TourSchedule::with('tour', 
														'tour.travel_agent', 'tour.travel_agent.images'
													)
										->whereIn('id', $ids)
										->published()
										->orderBy('departure')
										->get();
		}
		else
		{
			$tour_schedules = new Collection;
		}

		return Response::json(['data' => $tour_schedules->toArray()], 200);
	}

}
