<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToTravelAgentObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$travel_agent = new \App\TravelAgent;

		// RULES
		$rules['travel_agent_id']				= ['integer', 'min:1', 'exists:' . $travel_agent->getTable() . ',id'];

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
