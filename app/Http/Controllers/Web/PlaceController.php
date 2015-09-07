<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, \Illuminate\Support\Collection, Config, Cache;
use App\Tour;
use App\TravelAgent;
use App\Destination;
use App\Place;

use App\Jobs\FindPublishedTourSchedules;

class PlaceController extends Controller {

	public function index($destination_slug = null, $tag = null, $page = 1)
	{
		// ------------------------------------------------------------------------
		// REDIRECT IF THERE'S REQUEST QUERY
		// ------------------------------------------------------------------------
		if (Input::has('destination') || Input::has('tag'))
		{
			return redirect()->route('web.places', ['destination' => Input::get('destination'), 
													'kategori' => implode(',',Input::get('tag')),
													'page' => null
												] + Input::only('nama'));
		}

		// ------------------------------------------------------------------------
		// HANDLE FILTERS
		// ------------------------------------------------------------------------
		// Destination List
		$destination_list = Cache::remember('all_destination_list', 30, function() {
			return \App\Destination::orderBy('path')->get();
		});

		$destination_list = ['semua' => "Semua"] + $destination_list->lists('long_name', 'path_slug')->toArray();
		$filters['destination'] = $destination_slug;
		if (str_is('semua', $filters['destination']) || is_null($filters['destination']))
		{
			$filters['destination'] = null;
		}
		else
		{
			$destination = \App\Destination::findPath(str_replace(',', Destination::getDelimiter(), $filters['destination'].'*'))->first();
			if (!$destination)
			{
				return App::abort(404);
			}
		}

		// TAG LIST
		$tag_list = ['kuliner' 		=> 'food',
					 'belanja' 		=> 'bag', 
					 'budaya' 		=> 'culture',
					 'pemandangan'	=> 'nature',
					 'hiburan'		=> 'entertain',
					 'kesehatan'	=> 'briefcase-plus',
					];
		asort($tag_list);
		$filters['tags'] = array_filter(explode(',',$tag));
		if (!empty($filters['tags']))
		{
			foreach ($filters['tags'] as $x)
			{
				if (!array_key_exists($x, $tag_list))
				{
					App::abort(404);
				}
			}
		}

		// NAMA
		$filters['nama'] = Input::get('nama');


		// ------------------------------------------------------------------------
		// PREPARE QUERY
		// ------------------------------------------------------------------------
		// pagination
		$page = max(1, $page*1);
		$per_page = 10;
		$skip = ($page - 1) * $per_page;

		
		// ------------------------------------------------------------------------
		// EXECUTE QUERY
		// ------------------------------------------------------------------------
		$places = Cache::remember('all_place_in_' . serialize($filters) . '_skip' . $skip . '_take_' . $per_page , 30, function() use ($skip, $per_page, $filters) {
			$places = Place::inDestinationByPathAndChildren(str_replace(',', Destination::getDelimiter(), $filters['destination'].'*'))
							->published()
							->LongNameLike('*'.$filters['nama'].'*')
							->InTagByTag($filters['tags'])
							->skip($skip)
							->take($per_page)
							->latest('published_at')
							->get();
			$places->load('destination', 'images', 'upcoming_tours', 'upcoming_tours.schedules');
			return $places;
		});

		$place_count = Cache::remember('count_all_place_in_' . serialize($filters), 30, function() use ($skip, $per_page, $filters) {
			$places = Place::inDestinationByPathAndChildren(str_replace(',', Destination::getDelimiter(), $filters['destination'].'*'))
							->InTagByTag(explode(',',$filters['tags']))
							->published()
							->LongNameLike('*'.$filters['nama'].'*')
							->count();
			return $places;
		});


		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'places');
		$this->layout->page->destination 		= $destination;
		$this->layout->page->destination_list 	= $destination_list;
		$this->layout->page->tag_list 			= $tag_list;
		$this->layout->page->filters 			= $filters;
		$this->layout->page->places 			= $places;
		$this->layout->page->option_list 		= $this->option_list;

		$this->layout->page->current_page 		= $page;
		$this->layout->page->per_page 	 		= $per_page;
		$this->layout->page->start_pagination	= max(1, $page - 3);
		$this->layout->page->last_pagination	= min(ceil($place_count/$per_page), $page + 3);

		$this->layout->title					= "Tujuan Wisata "; 
		if ($destination->id)
		{
			$this->layout->title				.= "di " . $destination->name; 
		}
		$this->layout->title 					.= "- Capcus.id";


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
		$place = Place::inDestinationByPath(str_replace(',', \App\Destination::getDelimiter(), $destination_slug))
						->slugIs($place_slug)
						->published()
						->first();
		$place->load('images', 'destination');
		if (!$place)
		{
			\App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// OTHER PLACE FROM THE SAME DESTINATION
		// ------------------------------------------------------------------------------------------------------------		
		$other_places = Cache::remember('other_place_in_' . $place->destination->id, 60, function() use ($destination_slug, $place) {
			$other_places = Place::inDestinationByPath(str_replace(',', \App\Destination::getDelimiter(), $destination_slug))->where('id', '!=', $place->id)->published()->limit(8)->get();
			$other_places->load('images', 'destination');
			return $other_places;
		});

		// ------------------------------------------------------------------------------------------------------------
		// PAKET TOUR KE TEMPAT INI
		// ------------------------------------------------------------------------------------------------------------		
		$tour_schedules = Cache::remember('upcoming_tour_to_place_' . $place->id, 60, function() use ($place) {
			$tour_schedules = \App\TourSchedule::published()
									->whereHas('tour', function($q) use ($place) {
										$q->inPlaceByIds($place->id);
									})
									->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
									->limit(5)
									->oldest('departure')
									->get();
			$tour_schedules->load('tour', 'tour.travel_agent', 'tour.travel_agent.images', 'tour.travel_agent.active_packages', 'tour.places', 'tour.options', 'tour.destinations');
			return $tour_schedules;
		});


		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'place_detail');
		$this->layout->page->place 				= $place;
		$this->layout->page->other_places 		= $other_places;
		$this->layout->page->tour_schedules 	= $tour_schedules;
		$this->layout->page->option_list 		= $this->option_list;

		$this->layout->title					= $place->name . ' - Capcus.id';
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'article';
		$this->layout->og['image'] 				= $place->images->where('name', 'Gallery1')->path;
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 600;
		$this->layout->og['image:height'] 		= 400;

		return $this->layout;
	}
}