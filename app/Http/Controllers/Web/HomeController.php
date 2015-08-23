<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag;

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
		$headlines = \App\Headline::activeOn(\Carbon\Carbon::now())->orderBy('priority')->get();

		// ------------------------------------------------------------------------------------------------------------
		// QUERY HOME GRID
		// ------------------------------------------------------------------------------------------------------------
		$homegrids = \App\HomegridSetting::get();

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
			}
		}

		// ------------------------------------------------------------------------------------------------------------
		// QUERY PAKET PROMO
		// ------------------------------------------------------------------------------------------------------------
		$promo_tours = \App\TourSchedule::with('tour', 'tour.places', 'tour.destinations', 'tour.destinations.images')
										->published()
										->promo()
										->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYears(5))
										->orderby('departure')
										->limit(8)
										->get();


		// ------------------------------------------------------------------------------------------------------------
		// QUERY PAKET TOUR TERBARU
		// ------------------------------------------------------------------------------------------------------------
		$latest_tours = \App\Tour::with('destinations', 'schedules', 'destinations.images', 'places')->published()->latest()->limit(8)->get();

		// ------------------------------------------------------------------------------------------------------------
		// TOTAL UPCOMING TOUR
		// ------------------------------------------------------------------------------------------------------------
		$total_upcoming_tours = \App\TourSchedule::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(5))->count();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'home');
		$this->layout->page->headlines 		= $headlines;
		$this->layout->page->homegrids 		= $homegrids;
		$this->layout->page->latest_tours	= $latest_tours;
		$this->layout->page->promo_tours	= $promo_tours;
		$this->layout->page->total_upcoming_tours 	= $total_upcoming_tours;

		// search tour
		$this->layout->page->all_travel_agents 	= $this->all_travel_agents;
		$this->layout->page->all_destinations 	= $this->all_destinations;
		$this->layout->page->departure_list 	= $this->departure_list;
		$this->layout->page->budget_list 		= $this->budget_list;
		$this->layout->page->place_list 		= $this->place_list;

		return $this->layout;
	}
}