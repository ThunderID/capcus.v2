<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag;

use \App\Headline;
use \App\Tour;
use \App\TourSchedule;
use \App\Article;
use \Illuminate\Support\Collection;

class AboutController extends Controller {

	public function imvendor()
	{
		

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 				= view($this->page_base_dir . 'imvendor');
		return $this->layout;
	}
}