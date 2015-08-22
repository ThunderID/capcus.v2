<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App;
use \App\Article;

class BlogController extends Controller {

	public function index($page = 1)
	{
		$page = max(1, $page*1);
		$per_page = 10;
		$skip = ($page - 1) * $per_page;
		// ------------------------------------------------------------------------------------------------------------
		// QUERY ARTICLE
		// ------------------------------------------------------------------------------------------------------------
		$articles = Article::published()->latest('published_at')->skip($skip)->take($per_page)->get();
		$article_count = Article::published()->count();

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
		$this->layout->page->current_page 		= $page;

		return $this->layout;
	}


	public function show($year, $month, $slug)
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY ARTICLE DETAIL
		// ------------------------------------------------------------------------------------------------------------
		$article = Article::slugIs($slug)->published()->first();
		if (!$article || $article->published_at->year != $year * 1 || $article->published_at->month != $month * 1)
		{
			return App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// QUERY RELATED ARTICLES
		// ------------------------------------------------------------------------------------------------------------
		$destinations = $article->destinations;
		$related_articles = Article::InDestinationByIds($destinations->lists('id')->toArray())->where('id', '!=', $article->id)->published()->latest('published_at')->limit(5)->get();

		if (!$related_articles)
		{
			$related_articles = Article::latest('published_at')->where('id', '!=', $article->id)->limit(5)->get();
		}

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
		$this->layout->page->tours 		= $tours;

		return $this->layout;
	}
}