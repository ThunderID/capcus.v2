<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class TagObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// ------------------------------------------------------------
		// GENERATE RULES
		// ------------------------------------------------------------
		$rules['tag']				= ['required', 'alpha_num', 'unique:' . $model->getTable() . ',tag,'. ($model->id ? $model->id : 'NULL') . ',id'];
		// $model->name = strtolower($model->name);

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
		foreach ($model->images as $x)
		{
			$x->delete();
		}
	}
}
