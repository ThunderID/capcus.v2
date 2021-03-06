<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToPackageObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_model = new \App\Package;

		// RULES
		$rules['package_id']				= ['integer', 'min:1', 'exists:' . $tmp_model->getTable() . ',id'];

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
