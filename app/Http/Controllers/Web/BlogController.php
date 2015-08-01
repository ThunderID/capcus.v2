<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App;
use \App\PublishedArticle as Article;
use \App\PublishedTour as Tour;

class BlogController extends Controller {

	public function index($id = '')
	{
		// ------------------------------------------------------------------------------------------------------------
		// QUERY ARTICLE
		// ------------------------------------------------------------------------------------------------------------
		$articles = Article::latest('published_at')->paginate(10);

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'blog.index');
		$this->layout->page->articles 	= $articles;
		$this->init_right_sidebar();

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
		// QUERY RELATED TOUR
		// ------------------------------------------------------------------------------------------------------------
		$tours = Tour::scheduledBetween(\Carbon\Carbon::now(), \Carbon\Carbon::now()->addYear(1))
						->latest('published_at')
						->take(5)
						->get();

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'blog.show');
		$this->layout->page->article 	= $article;
		$this->layout->page->tours 	= $tours;
		$this->init_right_sidebar();


		return $this->layout;
	}
}