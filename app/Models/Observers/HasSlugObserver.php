<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class HasSlugObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules[$model->getSlugField()]				= ['required', 'unique:' . $model->getTable() . ',' . $model->getSlugField() . ',' . ($model->id ? $model->id .',id' : '')];

		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
	}

	public function saved($model)
	{
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
