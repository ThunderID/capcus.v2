<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class PackageTravelAgentObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$rules['active_since'] = ['required', 'date'];
		$rules['active_until'] = ['required', 'date', 'after:active_since', 'no_overlapping_date_range:'.$model->getTable().',active_since,active_until,' . $model->active_since . ',' . $model->active_until .',travel_agent_id,=,'.$model->travel_agent_id.',id,!=,' . $model->id ];
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
