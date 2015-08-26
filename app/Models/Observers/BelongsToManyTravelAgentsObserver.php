<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyTravelAgentsObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$dest_model = new \App\TravelAgent;

		// RULES
		if (is_array($model->travel_agent_ids))
		{
			foreach ($model->travel_agent_ids as $k => $v)
			{
				$rules['travel_agent_ids' . $k ]				= ['exists:' . $dest_model->getTable()];
			}
		}
		else
		{
			$rules['travel_agent_ids'] = ['exists:' . $dest_model->getTable()];
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
		$model->travel_agents()->sync(is_array($model->travel_agent_ids) ? $model->travel_agent_ids : [$model->travel_agent_ids]);
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
