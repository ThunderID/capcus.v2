<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class DestinationObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules = [];

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
		if ($model->places->count())
		{
			$model->setErrors('Fail to delete ' . $model->{$model->getNameField()} . ' as it\'s linked to some places');
			return false;
		}

		if ($model->tours->count())
		{
			$model->setErrors('Fail to delete ' . $model->{$model->getNameField()} . ' as it\'s linked to some tours');
			return false;
		}

		if ($model->articles->count())
		{
			$model->setErrors('Fail to delete ' . $model->{$model->getNameField()} . ' as it\'s linked to some articles');
			return false;
		}
	}

	public function deleted($model)
	{
		foreach ($model->images as $x)
		{
			$x->delete();
		}
	}	
}
