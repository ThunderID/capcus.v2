<?php 

namespace App;

use Illuminate\Database\Query\Builder as BaseBuilder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

class HomegridSettingScope implements ScopeInterface {

	/**
	 * Apply scope on the query.
	 * 
	 * @param \Illuminate\Database\Eloquent\Builder  $builder
	 * @param \Illuminate\Database\Eloquent\Model  $model
	 * @return void
	 */
	public function apply(Builder $builder, Model $model)
	{
		$builder->where('name', 'like', 'homegrid_%');

		// $this->extend($builder);
	}

	/**
	 * Remove scope from the query.
	 * 
	 * @param \Illuminate\Database\Eloquent\Builder  $builder
	 * @param \Illuminate\Database\Eloquent\Model  $model
	 * @return void
	 */
	public function remove(Builder $builder, Model $model)
	{
		$query = $builder->getQuery();
		$bindingKey = 0;

		foreach ((array) $query->wheres as $key => $where)
		{
			if (str_is('name', $key))
			{
				$this->removeWhere($query, $key);
			}
		}
	}
}
