<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag, Cache;

use \App\Headline;
use \App\Tour;
use \App\TourSchedule;
use \App\Article;
use \Illuminate\Support\Collection;

class HomeController extends Controller {

	public function index()
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		$headlines = Cache::remember('current_headline', 60, function() {
						return \App\Headline::activeOn(\Carbon\Carbon::now())->orderBy('priority')->get();
		});
		
		$headlines = $headlines->sortBy(function($headline) { 
			return rand(0,1000);
		});

		// ------------------------------------------------------------------------------------------------------------
		// QUERY HOME GRID
		// ------------------------------------------------------------------------------------------------------------
		$homegrids = Cache::remember('current_homegrids', 60, function() {
			$homegrids = \App\HomegridSetting::orderBy('name')->get();
			// get upcoming package schedules
			$homegrid_destination_ids = new Collection;
			foreach ($homegrids as $k => $v)
			{
				if (str_is('destination', $v->type))
				{
					$homegrid_destination_ids->push($v->destination);
				}
			}
			if ($homegrid_destination_ids->count())
			{
				$homegrid_destinations = \App\Destination::with('tours', 'tours.schedules')->whereIn('id', $homegrid_destination_ids)->get();
				foreach ($homegrids as $k => $v)
				{
					$homegrids[$k]->destination_detail = $homegrid_destinations->find($v->destination);
					$homegrids[$k]->destination_detail->total_upcoming_tours;
				}
			}

			return $homegrids;
		});


		// ------------------------------------------------------------------------------------------------------------
		// QUERY PAKET PROMO
		// ------------------------------------------------------------------------------------------------------------
		$promo_tours = Cache::remember('8_upcoming_promo_tours', 30, function(){
			return \App\TourSchedule::with('tour', 'tour.places', 'tour.places.images' ,'tour.destinations', 'tour.destinations.images', 'tour.travel_agent', 'tour.travel_agent.images', 'tour.schedules')
										->published()
										->promo()
										->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYears(5))
										->orderby('departure')
										->limit(8)
										->select('tour_schedules.*')
										->join('tours', 'tours.id', '=', 'tour_schedules.tour_id')
										->join('travel_agencies', 'travel_agencies.id', '=', 'tours.travel_agent_id')
										->groupBy('tours.travel_agent_id')
										->get();
		});


		// ------------------------------------------------------------------------------------------------------------
		// QUERY PAKET TOUR TERBARU
		// ------------------------------------------------------------------------------------------------------------
		$latest_tours = Cache::remember('8_latest_tours', 30, function(){ 
			return \App\Tour::with('destinations', 'schedules', 'destinations.images', 'places', 'places.images','travel_agent', 'travel_agent.images')
						->has('schedules')
						->select('tours.*')
						->join('travel_agencies', 'travel_agencies.id', '=', 'travel_agent_id')
						->published()
						->latest('tours.created_at')
						->limit(8)
						->groupBy('travel_agent_id')
						->get();
		});

		// ------------------------------------------------------------------------------------------------------------
		// TOP DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		$top_destinations = Cache::remember('8_top_destination_in_6_months', 30, function() { 
			return \App\Destination::with('images')->TopDestination(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addMonth(6))->limit(8)->get();
		});

		// ------------------------------------------------------------------------------------------------------------
		// TOTAL UPCOMING TOUR
		// ------------------------------------------------------------------------------------------------------------
		$total_upcoming_tours = Cache::remember('total_upcoming_tour_in_5_years', 60, function(){
			return \App\TourSchedule::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(5))->count();
		});

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'home');
		$this->layout->page->headlines 		= $headlines;
		$this->layout->page->homegrids 		= $homegrids;
		$this->layout->page->latest_tours	= $latest_tours;
		$this->layout->page->promo_tours	= $promo_tours;
		$this->layout->page->total_upcoming_tours 	= $total_upcoming_tours;
		$this->layout->page->top_destinations 	= $top_destinations;

		// search tour
		$this->layout->page->all_travel_agents 	= $this->all_travel_agents;
		$this->layout->page->all_destinations 	= $this->all_destinations;
		$this->layout->page->departure_list 	= $this->departure_list;
		$this->layout->page->budget_list 		= $this->budget_list;
		$this->layout->page->place_list 		= $this->place_list;

		// 
		$this->layout->title 					= "Capcus.id - Cari tour tidak lagi ribet";
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'website';
		$this->layout->og['image'] 				= asset('images/logo-black.png');
		$this->layout->og['image:type']			= 'image/png';
		$this->layout->og['image:width'] 		= 275;
		$this->layout->og['image:height'] 		= 121;
		return $this->layout;
	}
}