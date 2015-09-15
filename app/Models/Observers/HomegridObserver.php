<?php namespace App;

use Validator, \Illuminate\Support\MessageBag;

class HomegridObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		$tmp_dest = new \App\Destination;
		$tmp_tag = new \App\Tag;

		// RULES
		$rules['label']				= [''];
		$rules['image_url']			= ['required', 'url'];
		
		if (str_is('destination', strtolower($model->type)))
		{
			$rules['destination']		= ['integer', 'exists:' . $tmp_dest->getTable() . ',id'];
		}
		elseif (str_is('tour_tag', strtolower($model->type)))
		{
			$rules['tag']				= ['integer', 'exists:' . $tmp_tag->getTable() . ',id'];
		}
		elseif (str_is('script', strtolower($model->type)))
		{
			$rules['script']			= ['required'];
		}
		elseif (str_is('link', strtolower($model->type)))
		{
			$rules['link']			= ['required', 'url'];
		}

		$rules['title']				= ['required'];
		$rules['type']				= ['in:' . implode(',', \App\HomegridSetting::getType())];

		foreach ($rules as $k => $v)
		{
			$values[$k] = $model->$k;
		}

		$validator = Validator::make($values, $rules);
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
