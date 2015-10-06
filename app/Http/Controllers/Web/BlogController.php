<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App, Cache;
use \App\Article;

class BlogController extends Controller {


	public function index($page = 1)
	{
		$page = max(1, $page*1);
		$per_page = 12;
		$skip = ($page - 1) * $per_page;

		// ------------------------------------------------------------------------------------------------------------
		// QUERY ARTICLE
		// ------------------------------------------------------------------------------------------------------------
		$article_count = Cache::remember('published_article_count', 15, function(){
			return Article::published()->count();
		});
		$articles = Cache::remember('latest_articles_page' . $page, 15, function() use ($skip, $per_page) {
			return Article::published()->with('images')->latest('published_at')->skip($skip)->take($per_page)->get();
		});

		if (!$articles->count())
		{
			App::abort(404);
		}

		$start_pagination = max(1, $page - 3);
		$last_pagination = min(ceil($article_count/$per_page), $page + 3);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'blogs');
		$this->layout->page->articles 	= $articles;
		$this->layout->page->article_count 	= $article_count;
		$this->layout->page->start_pagination 	= $start_pagination;
		$this->layout->page->last_pagination 	= $last_pagination;
		$this->layout->page->top_destinations 	= $this->get_top_destinations();
		$this->layout->page->current_page 		= $page;
		$this->layout->page->latest_tours 		= $this->get_latest_tours();

		$this->layout->title 					= 'Travel Blog ' . ($page > 1 ? ' Halaman ' . $page : '') . ' - Capcus.id';
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'website';
		$this->layout->og['image'] 				= ($articles->count() ? $articles->first()->images->where('name', 'LargeImage')->first()->path : asset('images/logo-black.png'));
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 600;
		$this->layout->og['image:height'] 		= 400;


		return $this->layout;
	}


	public function show($year, $month, $slug)
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY ARTICLE DETAIL
		// ------------------------------------------------------------------------------------------------------------
		$article = Cache::remember('blog_with_slug_' . $slug, 30, function() use ($slug) {
			return Article::with('images','destinations')->slugIs($slug)->published()->first();
		}) ;
		if (!$article || $article->published_at->year != $year * 1 || $article->published_at->month != $month * 1)
		{
			return App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// QUERY RELATED ARTICLES
		// ------------------------------------------------------------------------------------------------------------
		$destinations = $article->destinations;
		$related_articles = Cache::remember('related_article_by_slug' . $slug, 30, function() use ($article, $destinations) { 
			$related_articles =  Article::InDestinationByIds($destinations->lists('id')->toArray())
								->where('id', '!=', $article->id)
								->published()
								->latest('published_at')
								->limit(6)
								->get();
			if (!$related_articles->count())
			{
				$related_articles = Article::latest('published_at')->where('id', '!=', $article->id)->limit(5)->get();
			}
			return $related_articles;
		});

		// ------------------------------------------------------------------------------------------------------------
		// QUERY RELATED TOUR
		// ------------------------------------------------------------------------------------------------------------
		// $tours = Tour::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
		// 				->latest('published_at')
		// 				->take(5)
		// 				->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page 			= view($this->page_base_dir . 'blog_detail');
		$this->layout->page->article 	= $article;
		$this->layout->page->related_articles 	= $related_articles;
		$this->layout->page->latest_tours 		= $this->get_latest_tours();
		$this->layout->page->top_destinations 	= $this->get_top_destinations();
		
		$this->layout->title 		= $article->title . ' - Capcus.id';
		$this->layout->og['title'] 				= $this->layout->title;
		$this->layout->og['type'] 				= 'article';
		$this->layout->og['image'] 				= $article->images->where('name', 'LargeImage')->first()->path;
		$this->layout->og['image:type']			= pathinfo('images/'.$this->layout->og['image'], PATHINFO_EXTENSION);
		$this->layout->og['image:width'] 		= 600;
		$this->layout->og['image:height'] 		= 400;
		$this->layout->og['article:published_at'] = $article->published_at->format('Y-m-d H:i:s');


		return $this->layout;
	}

	protected function get_latest_tours() { 

		// ------------------------------------------------------------------------------------------------------------
		// QUERY PAKET TOUR TERBARU
		// ------------------------------------------------------------------------------------------------------------
		return Cache::remember('8_latest_tours', 30, function(){ 
			return \App\Tour::with('destinations', 'schedules', 'destinations.images', 'places', 'travel_agent', 'travel_agent.images')->published()->latest()->limit(8)->get();
		});
	}

	protected function get_top_destinations() { 
		// ------------------------------------------------------------------------------------------------------------
		// TOP DESTINATION
		// ------------------------------------------------------------------------------------------------------------
		return Cache::remember('get_top_destinations', 15, function(){
			return \App\Destination::with('images')->TopDestination(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addMonth(6))->limit(6)->get();
		});

	}

}