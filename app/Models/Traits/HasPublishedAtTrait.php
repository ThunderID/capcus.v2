<?php namespace App;

use Illuminate\Support\MessageBag;

trait HasPublishedAtTrait {
	
	public function scopePublished($q)
	{
		return $q->where('published_at', '<=', \Carbon\Carbon::now());
	}

	public function scopeUpcoming($q)
	{
		return $q->where('published_at', '>', \Carbon\Carbon::now());
	}

	public function scopeDraft($q)
	{
		return $q->whereNull('published_at');
	}
}

