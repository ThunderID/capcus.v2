<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyDestinationsObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$dest_model = new \App\Destination;

		// RULES
		if (is_array($model->destination_ids))
		{
			foreach ($model->destination_ids as $k => $v)
			{
				$rules['destination_ids' . $k ]				= ['exists:' . $dest_model->getTable()];
			}
		}
		else
		{
			$rules['destination_ids'] = ['exists:' . $dest_model->getTable()];
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
		$model->destinations()->sync(is_array($model->destination_ids) ? $model->destination_ids : [$model->destination_ids]);
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
