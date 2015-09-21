<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class SubscriberObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules['email']			= ['required', 'email', 'unique:' . $model->getTable() . ',email,' . ($model->id ? $model->id : 'NULL') . ',id'];
		$rules['is_subscribe']	= ['required', 'boolean'];
		
		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
	}

	public function saved($model)
	{
		if ($model->tmp_destinations)
		{
			$model->destinations()->sync($model->tmp_destinations);
		}
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
		// if ($model->children->count())
		// {
		// 	$model->setErrors(new MessageBag(['hasChildren' => 'unable to delete this content as it has children content']));
		// 	return false;
		// }	
	}

	public function deleted($model)
	{
		foreach ($model->images as $x)
		{
			$x->delete();
		}
	}
}
