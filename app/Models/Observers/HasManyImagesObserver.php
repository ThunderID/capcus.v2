<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class HasManyImagesObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_model = new \App\Image;

		// RULES
		if (is_array($model->image_ids))
		{
			foreach ($model->image_ids as $k => $v)
			{
				$rules['image_ids' . $k ]				= ['exists:' . $tmp_model->getTable()];
			}
		}
		else
		{
			$rules['image_ids'] = ['exists:' . $tmp_model->getTable()];
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
