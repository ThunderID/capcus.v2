<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyPlacesObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_model = new \App\Place;

		// RULES
		if (is_array($model->place_ids))
		{
			foreach ($model->place_ids as $k => $v)
			{
				$rules['place_ids' . $k ]				= ['exists:' . $tmp_model->getTable()];
			}
		}
		else
		{
			$rules['place_ids'] = ['exists:' . $tmp_model->getTable()];
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
		$model->places()->sync(is_array($model->place_ids) ? $model->place_ids : [$model->place_ids]);
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
