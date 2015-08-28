<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class PlaceObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// ------------------------------------------------------------
		// GENERATE Slug
		// ------------------------------------------------------------
		if (!$model->slug)
		{
			$i = 0;
			do {
				$model->slug = str_slug($model->name . ($i ? '-' . $i : '')) ;
				$i++;
			} while (\App\Place::SlugIs($model->slug)->where('id', '!=', $model->id ? $model->id : 0)->count());
		}

		// ------------------------------------------------------------
		// GENERATE LONG NAME
		// ------------------------------------------------------------
		$model->long_name = $model->name;
		$destination = $model->destination;
		do {
			$model->long_name .= ', ' . $destination->name;
			$destination = $destination->parent;
		} while ($destination->name);

		// ------------------------------------------------------------
		// GENERATE RULES
		// ------------------------------------------------------------
		$rules['summary']				= ['required', 'min:40'];
		$rules['content']				= ['required', 'min:100'];
		$rules['longitude']				= ['numeric'];
		$rules['latitude']				= ['numeric'];

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
