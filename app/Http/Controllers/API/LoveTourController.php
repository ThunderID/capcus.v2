<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;

use Auth, Route, Input, Response;
use \App\User, \App\Tour;

class LoveTourController extends Controller {

	public function toggle_love()
	{
		$tour_slug = Input::get('tour_slug');
		// get user
		$user = Auth::user();
		if (!$user)
		{
			$jsend = new \ThunderID\jsend\jsend('fail', ['error' => 'Login Required']);
			return Response::json($jsend->toArray(), 400);
		}

		// get tour
		$tour = Tour::SlugIs($tour_slug)->first();
		if (!$tour)
		{
			$jsend = new \ThunderID\jsend\jsend('fail', ['error' => 'Tour not found']);
			return Response::json($jsend->toArray(), 400);
		}

		// add love
		$already_love = false;
		foreach ($user->love as $x)
		{
			if ($x->id == $tour->id)
			{
				$already_love = true;
			}
		}
		if ($already_love)
		{
			$user->love()->detach($tour->id);
		}
		else
		{
			$user->love()->attach($tour->id);
		}

		// return message
		$jsend = new \ThunderID\jsend\jsend('success', ['love' => $already_love ? 0 : 1]);
		return Response::json($jsend->toArray(), 200);
	}

}
