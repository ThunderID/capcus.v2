<?php namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;
use Auth, Route, Input, Session, Cache;

use \App\TravelAgent;
use \App\Destination;
use \App\Article;
use \App\Place;

abstract class Controller extends BaseController {

	protected $layout;

	function __construct()
	{
		$this->layout_base_dir 	= 'web.v4.';
		$this->page_base_dir 	= $this->layout_base_dir . 'pages.';

		// ------------------------------------------------------------------------------------------------------------
		// BASIC LAYOUT
		// ------------------------------------------------------------------------------------------------------------
		$this->layout 			= view($this->layout_base_dir.'page_templates.v4');
		$this->layout->basic 	= view($this->layout_base_dir.'page_templates.v4_content');
		$this->init_search_tour();
		$this->init_search_place();
		$this->compare_tour();
		$this->layout->basic->tour_shortcut 	= $this->tour_shortcut;

		// ------------------------------------------------------------------------------------------------------------
		// HANDLE REDIRECT
		// ------------------------------------------------------------------------------------------------------------
		if (Input::has('redirect'))
		{
			Session::put('redirect', Input::get('redirect'));
		}
	}

	function init_search_tour()
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET TRAVEL AGENT
		// ------------------------------------------------------------------------------------------------------------
		$this->all_travel_agents = Cache::remember('all_travel_agent_list', 60, function() {
			return TravelAgent::orderby('name')->get();
		});

		// ------------------------------------------------------------------------------------------------------------
		// GET DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		$this->all_destinations = Cache::remember('all_destination_list', 60, function() {
			return Destination::orderby('name')->get();
		});

		// ------------------------------------------------------------------------------------------------------------
		// GET DEPARTURE LISTS
		// ------------------------------------------------------------------------------------------------------------
		$month = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
		$now = \Carbon\Carbon::now();
		$departure_list = [];
		for ($i = 1; $i <= 12; $i++)
		{
			$departure_list[$now->year . str_pad($now->month, '2', '0', STR_PAD_LEFT)] = $month[$now->month] . ' ' . $now->year;
			$now->addMonth();
		}
		$this->departure_list = $departure_list;

		// ------------------------------------------------------------------------------------------------------------
		// GET BUDGET
		// ------------------------------------------------------------------------------------------------------------
		$this->budget_list = [
								0	 				 => "Semua budget",
								'0-1000000' 		 => "Di bawah Rp. 1.000.000",
								'1000000-2500000' 	 => "Rp. 1.000.000 - Rp. 2.500.000",
								'2500000-5000000' 	 => "Rp. 2.500.000 - Rp. 5.000.000",
								'5000000-10000000' 	 => "Rp. 5.000.000 - Rp. 10.000.000",
								'10000000-20000000'  => "Rp. 10.000.000 - Rp. 20.000.000",
								'20000000' 			 => "Rp. 20.000.000 ke atas",
					  		];

  		// ------------------------------------------------------------------------
		// TOUR OPTIONS
		// ------------------------------------------------------------------------
		$this->option_list = Cache::remember('all_option_list', 120, function(){
			return \App\TourOption::orderBy('name')->get();
		});

		// ------------------------------------------------------------------------
		// SHORTCUT TOUR LIST
		// ------------------------------------------------------------------------
		$this->tour_shortcut['destinations']['Eropa Barat'] = route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'eropa,eropa-barat']);
		$this->tour_shortcut['destinations']['Eropa Timur'] = route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'eropa,eropa-timur']);
		$this->tour_shortcut['destinations']['Asia'] 		= route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'asia']);
		$this->tour_shortcut['destinations']['Australia'] 	= route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'australia']);
		$this->tour_shortcut['destinations']['Amerika'] 	= route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'amerika']);
		$this->tour_shortcut['destinations']['China'] 		= route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'asia,china']);
		$this->tour_shortcut['destinations']['Domestik'] 	= route('web.tour', ['travel_agent' => 'semua-travel-agent', 'destination' => 'domestik']);
		$this->tour_shortcut['tags']['#Religius'] 			= route('web.tour.tag', ['tag' => 'religius']);
		$this->tour_shortcut['tags']['#Adventure'] 			= route('web.tour.tag', ['tag' => 'adventure']);
		$this->tour_shortcut['tags']['#HoneyMoon'] 			= route('web.tour.tag', ['tag' => 'honeymoon']);

		ksort($this->tour_shortcut['destinations']);
		ksort($this->tour_shortcut['tags']);
	}

	function init_search_place()
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET PLACE
		// ------------------------------------------------------------------------------------------------------------
		$this->place_list = Cache::remember('all_place_list', 60, function() { 
			return Place::published()->orderBy('long_name')->get();
		});
	}

	function compare_tour()
	{
		// dd(Session::get('compare_cart'));
		if (Session::has('compare_cart'))
		{
			$ids = Session::get('compare_cart', []);
			foreach ($ids as $k => $v)
			{
				if (is_null($v) || !$v)
				{
					unset($ids[$k]);
				}
			}

			Session::put('compare_cart', $ids);
		}
		$this->layout->basic->compare_cart = \App\TourSchedule::with('tour', 
														'tour.travel_agent', 'tour.travel_agent.images'
													)
												->whereIn('id', $ids)
												->published()
												->orderBy('departure')
												->get();
	}
}