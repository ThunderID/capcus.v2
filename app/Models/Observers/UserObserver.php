<?php namespace App;

use Validator, \Illuminate\Support\MessageBag, Hash;
use Illuminate\Foundation\Bus\DispatchesCommands;

class UserObserver {

	// ----------------------------------------------------------------
	// SAVE
	// ----------------------------------------------------------------
	public function saving($model)
	{
		// RULES
		$rules['name']									= ['required', 'min:3'];
		$rules['email']									= ['email', 'unique:' . $model->getTable() . ',email,' . ($model->id ? $model->id : "NULL") . ',id'];
		if (!$model->id)
		{
			$rules['password']								= ['required', 'min:8'];
		}
		$rules['is_admin']								= ['boolean'];
		$rules['telp']									= ['numeric'];
		if ($model->dob->year != -1)
		{
			$rules['dob']									= ['date'];
		}
		$rules['gender']								= ['in:pria,wanita'];
		$rules['sso_twitter_id'] 						= ['unique:' . $model->getTable() . ',sso_twitter_id,' . ($model->id ? $model->id : "NULL") . ',id'];
		$rules['sso_twitter_data'] 						= [''];
		if ($model->sso_twitter_updated_at->year != -1)
		{
			$rules['sso_twitter_updated_at'] 				= ['date'];
		}
		$rules['sso_facebook_id'] 						= ['unique:' . $model->getTable() . ',sso_facebook_id,' . ($model->id ? $model->id : "NULL") . ',id'];
		$rules['sso_facebook_data'] 					= [''];
		if ($model->sso_facebook_updated_at->year != -1)
		{
			$rules['sso_facebook_updated_at'] 				= ['date'];
		}
		$rules['avatar'] 								= ['url'];

		$user = $model->toArray();
		$user['password'] = $model->password;
		$validator = Validator::make($user, $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
		else
		{
			if (Hash::needsRehash($user['password']))
			{
				$model->password = Hash::make($model->password);
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
		// ADD TO SUBSCRIBER
		if ($model->email)
		{
			$subscriber = \App\Subscriber::where('user_id','=', $model->id)->first();
			if (!$subscriber)
			{
				$subscriber = new \App\Subscriber();
				$subscriber->email = $model->email;
				$subscriber->is_subscribe = 1;
				$subscriber->user_id = $model->id;
				$subscriber->save();
			}
		}

		// SEND WELCOME EMAIL
		event(new \App\Events\NewMemberRegistered($model));
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
