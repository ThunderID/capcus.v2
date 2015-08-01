<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class ArticleObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules['summary']			= ['required', 'min:10'];
		$rules['content']			= ['required', 'min:30'];

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
		// if ($model->children->count())
		// {
		// 	$model->setErrors(new MessageBag(['hasChildren' => 'unable to delete this content as it has children content']));
		// 	return false;
		// }	
	}

	public function deleted($model)
	{

	}
}
