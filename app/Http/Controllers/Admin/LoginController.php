<?php namespace App\Http\Controllers\Admin;

use Auth, Input, \Illuminate\Support\MessageBag;

class LoginController extends Controller {

	public function getLogin()
	{
		$this->layout->page = view('admin.pages.login.form');

		return $this->layout;
	}

	public function postLogin()
	{
		$credentials = Input::only('email', 'password');
		if (Auth::attempt($credentials))
		{
			return redirect()->intended(route('admin.dashboard'));
		}
		else
		{
			return redirect()->back()->withErrors(new MessageBag(['login' => 'Invalid Username & Password']));
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('admin.login');
	}


}