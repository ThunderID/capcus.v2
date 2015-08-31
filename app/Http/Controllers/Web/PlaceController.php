<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, \Illuminate\Support\Collection, Config, Cache;
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
		$places = Cache::remember('all_place_in_' . $destination_slug . '_page' . $page , 30, function() {
			$places = Place::inDestinationBySlug($destination_slug)->published()->skip($skip)->take($per_page)->latest('published_at')->paginate();
			$places->load('destination', 'images', 'tours', 'tours.travel_agent', 'tours.travel_agent.images');
			return $places;
		});

		// ------------------------------------------------------------------------
		// PREPARE FILTERS FOR RESULTS
		// ------------------------------------------------------------------------
		
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'places');
		$this->layout->page->places 			= $places;

		$this->layout->title					= "Tujuan Wisata - Capcus.id";
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'website';
		$this->layout->og['image'] 				= ($places->count() ? $places->first()->images->where('name', 'LargeImage')->path : asset('images/logo-black.png'));
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 275;
		$this->layout->og['image:height'] 		= 121;

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

		$this->layout->title					= $place->name . ' - Capcus.id';
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'website';
		$this->layout->og['image'] 				= $place->images->where('name', 'LargeImage')->path;
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 275;
		$this->layout->og['image:height'] 		= 121;

		return $this->layout;
	}
}