<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class TravelAgentObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules['name'] 		= ['required']; 
		$rules['email'] 	= ['required', 'email']; 
		$rules['slug'] 		= ['required', 'alpha_dash']; 
		$rules['address'] 	= ['required', 'min:20'];
		$rules['phone'] 	= ['required'];		

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
		if ($model->tours->count())
		{
			$model->setErrors(new MessageBag(['HasTours' => 'unable to delete this travel agent as it has some tours']));
			return false;
		}	
	}

	public function deleted($model)
	{
	}
}
