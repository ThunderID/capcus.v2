<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class TreeObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$new_instance = $model->newInstance();

		// RULES
		$rules['parent_id']				= ['integer', 'min:0'];
		if ($model->parent_id)
		{
			$rules['parent_id'][] = 'exists:' . $model->getTable() . ',id';
		}


		$validator = Validator::make($model->toArray(), $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
		else 
		{
			if ($model->parent_id)
			{
				$parent = $new_instance->findorfail($model->parent_id);

				$model->{$model->getPathField()}  = $parent->ori_path;
				$model->{$model->getPathField()} = ($model->ori_path ? $model->ori_path . $model->getDelimiter() : '') . str_slug($model->{$model->getNameField()});
			}
			else
			{
				$model->{$model->getPathField()} = str_slug($model->{$model->getNameField()});
			}

			// Check Duplicated path
			$rules['ori_path'] = ['unique:' . $new_instance->getTable() . ',path,' . ($model->id ? $model->id : 'NULL') . ',id'];
			$validator = Validator::make(['ori_path' => $model->ori_path], $rules, ['unique' => 'Data ' . $model->{$model->getNameField()} . ' already exists']);
			if ($validator->fails())
			{
				$model->setErrors($validator->messages());
				return false;
			}
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
		if (!str_is($model->{$model->getPathField()}, $model->getOriginal($model->getPathField())))
		{
			foreach ($model->children as $x)
			{
				$x->save();
			}
		}
	}

	// ----------------------------------------------------------------
	// DELETE
	// ----------------------------------------------------------------
	public function deleting($model)
	{
		if ($model->children->count())
		{
			$model->setErrors('Fail to delete ' . $model->{$model->getNameField()} . ' as it has subtrees');
			return false;
		}
	}

	public function deleted($model)
	{

	}
}
