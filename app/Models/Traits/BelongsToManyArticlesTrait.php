<?php namespace App;

use Illuminate\Support\MessageBag;

trait BelongsToManyArticlesTrait {

	protected $article_ids;

	//------------------------------------------------------------------------
	// BOOT
	//------------------------------------------------------------------------
	function bootBelongsToManyArticlesTrait()
	{
		Static::observe(new BelongsToManyArticlesObserver);
	}

	//------------------------------------------------------------------------
	// RELATIONSHIP
	//------------------------------------------------------------------------
	function articles()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Article');
	}

	//------------------------------------------------------------------------
	// SCOPE
	//------------------------------------------------------------------------
	function scopeInArticleByIds($q, $v = null)
	{
		if (!$v || (is_array($v) && empty($v)))
		{
			return $q;
		}
		else
		{
			return $q->whereHas('articles', function($q) use ($v) {
				$q->whereIn('id', is_array($v) ? $v : [$v]);
			});
		}
	}

	//------------------------------------------------------------------------
	// ACCESSOR
	//------------------------------------------------------------------------
	function getArticleIdsAttribute()
	{
		if (isset($this->article_ids))
		{
			return $this->article_ids;
		}
		else
		{
			return $this->articles->lists('id')->toArray();
		}
	}

	//------------------------------------------------------------------------
	// MUTATOR
	//------------------------------------------------------------------------
	function setArticleIdsAttribute( $v )
	{
		$this->article_ids = $v;
	}	
}
