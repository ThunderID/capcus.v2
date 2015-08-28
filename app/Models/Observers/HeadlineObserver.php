<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;
use \App\TravelAgent;

class HeadlineObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_vendor = new TravelAgent;
		
		// RULES
		$rules['active_since'] 	= ['required'];
		$rules['active_until'] 	= ['required', 'after:active_since'];
		$rules['title'] 		= ['required'];
		$rules['link_to'] 		= ['required', 'url'];
		$rules['priority'] 		= ['required', 'integer'];

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
		foreach ($model->images as $image)
		{
			$image->delete();
		}
	}
}
