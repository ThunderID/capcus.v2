<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag;

use \App\Headline;
use \App\PublishedTour as Tour;
use \App\PublishedArticle as Article;

class HomeController extends Controller {

	public function index($id = '')
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		$headlines = \App\Headline::activeOn($this->now)->get();

		// ------------------------------------------------------------------------------------------------------------
		// QUERY TOUR
		// ------------------------------------------------------------------------------------------------------------
		$tours = Tour::with('schedules','vendor','loved')->scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'home');
		$this->layout->page->headlines 	= $headlines;
		$this->layout->page->tours 		= $tours;
		$this->init_right_sidebar();

		return $this->layout;
	}

	public function index2()
	{
		$this->layout = view('web.page_templates.default3');
		return $this->layout;
	}
}