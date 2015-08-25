<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class BelongsToManyTagsObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tag_model = new \App\Tag;

		// RULES
		if (is_array($model->tag_ids))
		{
			foreach ($model->tag_ids as $k => $v)
			{
				$rules['tag_ids' . $k ]				= ['exists:' . $tag_model->getTable()];
			}
		}
		else
		{
			$rules['tag_ids'] = ['exists:' . $tag_model->getTable()];
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
		$model->tags()->sync(is_array($model->tag_ids) ? $model->tag_ids : [$model->tag_ids]);
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
