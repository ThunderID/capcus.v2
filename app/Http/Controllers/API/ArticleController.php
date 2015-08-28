<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;

use Auth, Route, Input, Response;
use \App\Article;

class ArticleController extends Controller {

	public function getLatest()
	{
		$q = Input::get('q');

		if (strlen($q) >= 3)
		{
			return Response::json(Article::FindTitle("*".$q."*")->latest('published_at')->with('user')->get()->toArray(), 200);
		}
		else
		{
			return Response::json([], 401);
		}

	}

}
