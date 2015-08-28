<?php namespace App\Http\Controllers\Web;

use Auth, Input, Exception, \Illuminate\Support\MessageBag;

use \App\Headline;
use \App\Tour;
use \App\TourSchedule;
use \App\Article;
use \Illuminate\Support\Collection;

class NewsletterController extends Controller {

	public function send()
	{
		// ------------------------------------------------------------------------------------------------------------
		// GET HEADLINE
		// ------------------------------------------------------------------------------------------------------------
		$headlines = \App\Headline::with('travel_agent')->activeOn(\Carbon\Carbon::now())->orderBy('priority')->get();
		$headlines = $headlines->sortByDesc(function($data){
			return $data->travel_agent->active_packages[0]->priority;
		});

		// ------------------------------------------------------------------------------------------------------------
		// GET HOMEGRID
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
		// QUERY PAKET PROMO TERBARU
		// ------------------------------------------------------------------------------------------------------------
		$tours = \App\Tour::ByPriorityTravelAgent(10);
		$tours->load('travel_agent', 'travel_agent.active_packages', 'destinations', 'destinations.images', 'schedules');

		// ------------------------------------------------------------------------------------------------------------
		// GET BLOG TERBARU
		// ------------------------------------------------------------------------------------------------------------
		$articles = Article::with('images')->published()->latest('published_at')->take(6)->get();

		// ------------------------------------------------------------------------------------------------------------
		// GET USER
		// ------------------------------------------------------------------------------------------------------------
		\App\Subscriber::with('user')->active()->orderby('id')->chunk(100, function($subscribers){
			foreach ($subscribers as $subscriber)
			{
				Mail::queue($this->page_base_dir . 'newsletters.weekly', ['headlines' => $headlines, 'homegrids' => $homegrids, 'tours' => $tours, 'articles' => $articles, 'subscriber' => $subscriber], function ($m) use ($subscriber) {
					$m->to($subscriber->email, $subscriber->user ? $subscriber->name)->subject('CAPCUS.id - Newsletter Edisi ' . \Carbon\Carbon::now()->year . '.' . \Carbon\Carbon::now()->format('W');
				});
			}
		});

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->page 				= view($this->page_base_dir . 'newsletters.weekly');
		$this->page->headlines		= $headlines;
		$this->page->homegrids		= $homegrids;
		$this->page->tours			= $tours;	
		$this->page->articles		= $articles;	
		return $this->page;
	}

	
}