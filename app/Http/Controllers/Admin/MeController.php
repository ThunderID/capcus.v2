<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag, \App\User, Validator, Hash;

class MeController extends Controller {

	protected $model;
	protected $view_name = 'me';
	protected $route_name = 'me';


	public function getUpdatePassword()
	{
		// ---------------------------------------- GENERATE PAGE ----------------------------------------
		$this->layout->content = view('admin.pages.'.$this->view_name.'.update_password')->with('route_name', $this->route_name);

		return $this->layout;
	}

	public function postUpdatePassword()
	{
		$me = Auth::user();
		// validation
		$rules['current_password'] 	= ['required'];
		$rules['new_password'] 		= ['required', 'confirmed'];
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails())
		{
			return redirect()->back()->withErrors($validation);
		}

		// check old password
		if (!Hash::check(Input::get('new_password'), $me->password))
		{
			return redirect()->back()->withErrors(new MessageBag(['invalid_password' => 'Invalid current password']));
		}

		$me->password = Input::get('new_password');
		$me->save();
		return redirect()->back()->with('alert_success', 'Your password has been updated');
	}


}