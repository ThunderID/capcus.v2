<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;

use Auth, Route, Input, Response, Session;
use \App\User, \App\Tour;

class CompareTour extends Controller {

	public function add()
	{
		$ids = Session::get('compare_cart');
		if (Input::has('id'))
		{
			if (!is_array($ids))
			{
				$ids = [$ids];
			}
			$ids = array_merge($ids, [Input::get('id') * 1]);
			$ids = array_unique($ids);
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

		return Response::json($tour_schedules->toArray(), 200);
	}

}
