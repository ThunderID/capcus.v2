<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyTourOptionsObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_model = new \App\TourOption;

		// RULES
		if (is_array($model->option_ids))
		{
			foreach ($model->option_ids as $k => $v)
			{
				$rules['option_ids' . $k ]				= ['exists:' . $tmp_model->getTable()];
			}
		}
		else
		{
			$rules['option_ids'] = ['exists:' . $tmp_model->getTable()];
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
		$model->options()->sync(is_array($model->option_ids) ? $model->option_ids : [$model->option_ids]);
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
