<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag;

use \App\Headline;
use \App\Tour;
use \App\Article;

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

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 			= view($this->page_base_dir . 'home');
		$this->layout->page->headlines 	= $headlines;

		// search tour
		$this->layout->page->all_travel_agents 	= $this->all_travel_agents;
		$this->layout->page->all_destinations 	= $this->all_destinations;
		$this->layout->page->departure_list 	= $this->departure_list;
		$this->layout->page->budget_list 		= $this->budget_list;

		return $this->layout;
	}
}