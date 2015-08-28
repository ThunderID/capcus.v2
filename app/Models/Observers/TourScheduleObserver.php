<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class TourScheduleObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules['departure']				= ['required', 'date'];
		$rules['departure_until']		= ['date', 'after:departure'];
		$rules['currency']				= ['required', 'in:IDR'];
		$rules['original_price']		= ['required', 'numeric', 'min:0'];
		$rules['discounted_price']		= ['required', 'numeric', 'min:0'];

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
