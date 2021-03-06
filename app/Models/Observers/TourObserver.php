<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class TourObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules['ittenary']			= [];
		$rules['description']		= [];
		$rules['duration_day']		= ['numeric', 'min:0'];
		$rules['duration_night']	= ['numeric', 'min:0'];

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
