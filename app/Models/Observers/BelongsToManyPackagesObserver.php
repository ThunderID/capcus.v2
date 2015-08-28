<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyPackagesObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_model = new \App\Package;

		// RULES
		if (is_array($model->package_ids))
		{
			foreach ($model->package_ids as $k => $v)
			{
				$rules['package_ids' . $k ]				= ['exists:' . $tmp_model->getTable()];
			}
		}
		else
		{
			$rules['package_ids'] = ['exists:' . $tmp_model->getTable()];
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
		$model->packages()->sync(is_array($model->package_ids) ? $model->package_ids : [$model->package_ids]);
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
