<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class HasSlugObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		if (!$model->{$model->getSlugField()})
		{
			$i = 0;
			while (!$model->{$model->getSlugField()}) {
				if (!$model->{$model->getNameField()})
				{
					throw new Exception("This model does not have any name field", 1);
				}
				$slug = str_slug($model->{$model->getNameField()} . ($i ? ' ' . $i : ''));
				# code...
				if ($model->newInstance()->SlugIs($slug)->count())
				{
					$i++;
				}
				else
				{
					$model->{$model->getSlugField()} = $slug;
				}
			}
		}
		// RULES
		$rules[$model->getSlugField()]				= ['required', 'alpha_dash', 'unique:' . $model->getTable() . ',' . $model->getSlugField() . ',' . ($model->id ? $model->id .',id' : '')];

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
