<?php namespace App;

use Illuminate\Database\Query\Builder as BaseBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;


class AlreadyPublishedScope implements ScopeInterface {

	public function apply(Builder $builder, Model $model)
	{
		$builder->where('published_at', '<=', \Carbon\Carbon::now())->whereNotNull('published_at');

		// $this->extend($builder);
	}

	public function remove(Builder $builder, Model $model)
	{
	}

	
}