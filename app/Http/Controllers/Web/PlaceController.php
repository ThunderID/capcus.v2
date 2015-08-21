<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, \Illuminate\Support\Collection, Config;
use App\Tour;
use App\TravelAgent;
use App\Destination;
use App\Place;

use App\Jobs\FindPublishedTourSchedules;

class PlaceController extends Controller {

	public function index($destination_slug = null)
	{
		// ------------------------------------------------------------------------
		// GET PLACES
		// ------------------------------------------------------------------------
		$places = Place::inDestinationBySlug($destination_slug)->published()->latest()->get();
		$places->load('destination', 'images', 'tours', 'tours.travel_agent', 'tours.travel_agent.images');

		// ------------------------------------------------------------------------
		// PREPARE FILTERS FOR RESULTS
		// ------------------------------------------------------------------------
		
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'places');
		$this->layout->page->places 			= $places;

		return $this->layout;
	}

	public function show($destination_slug, $place_slug)
	{
		// ------------------------------------------------------------------------------------------------------------
		// DETAIL PLACE
		// ------------------------------------------------------------------------------------------------------------		
		$place = Place::inDestinationBySlug($destination_slug)->slugIs($place_slug)->published()->first();
		if (!$place)
		{
			\App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'place_detail');
		$this->layout->page->place 			= $place;

		return $this->layout;
	}
}