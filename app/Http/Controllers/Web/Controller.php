<?php namespace App\Http\Controllers\Web;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;
use Auth, Route, Input, Session;

use \App\TravelAgent;
use \App\Destination;
use \App\Article;
use \App\Place;

abstract class Controller extends BaseController {

	protected $layout;

	function __construct()
	{
		$this->layout_base_dir 	= 'web.v3.';
		$this->page_base_dir 	= $this->layout_base_dir . 'pages.';

		// ------------------------------------------------------------------------------------------------------------
		// BASIC LAYOUT
		// ------------------------------------------------------------------------------------------------------------
		$this->layout 			= view($this->layout_base_dir.'page_templates.v3');
		$this->layout->basic 	= view($this->layout_base_dir.'page_templates.v3_content');
		$this->init_search_tour();
		$this->init_search_place();

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
		$this->all_travel_agents = TravelAgent::orderby('name')->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		$this->all_destinations = Destination::orderby('path')->get();

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

	}

	function init_search_place()
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET PLACE
		// ------------------------------------------------------------------------------------------------------------
		$this->place_list = Place::published()->orderBy('long_name')->get();
	}
}