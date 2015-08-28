<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyArticlesObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_model = new \App\TourOption;

		// RULES
		if (is_array($model->article_ids))
		{
			foreach ($model->article_ids as $k => $v)
			{
				$rules['article_ids' . $k ]				= ['exists:' . $tmp_model->getTable()];
			}
		}
		else
		{
			$rules['article_ids'] = ['exists:' . $tmp_model->getTable()];
		}

		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
	}

	public function saved($model)
	{
		$model->articles()->sync(is_array($model->article_ids) ? $model->article_ids : [$model->article_ids]);
	}

	// ----------------------------------------------------------------
	// CREATE
	// ----------------------------------------------------------------
	public function creating($model)
	{

	}

	public function created($model)
	{

	}

	// ----------------------------------------------------------------
	// UPDATE
	// ----------------------------------------------------------------
	public function updating($model)
	{

	}

	public function updated($model)
	{

	}

	// ----------------------------------------------------------------
	// DELETE
	// ----------------------------------------------------------------
	public function deleting($model)
	{
		
	}

	public function deleted($model)
	{

	}
}
