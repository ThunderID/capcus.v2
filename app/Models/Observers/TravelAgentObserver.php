<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class TravelAgentObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// Create Slug
		if (!$model->slug)
		{
			$i = 0;
			do {
				$model->slug = str_slug($model->name . ($i ? '-' . $i : '')) ;
				$i++;
			} while (\App\Place::SlugIs($model->slug)->where('id', '!=', $model->id ? $model->id : 0)->count());
		}
		
		// RULES
		$rules['email']				= ['email'];

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
