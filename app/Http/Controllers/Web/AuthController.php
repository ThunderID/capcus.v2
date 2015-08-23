<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag, App;
use Socialize;
use \App\User;
use \App\Jobs\CreateMemberFromFacebook, \App\Jobs\CreateMemberFromTwitter;

class AuthController extends Controller {

	public function login($provider)
	{
		if (Auth::user())
		{
			Auth::logout();
		}

		switch (strtolower($provider)) {
			case 'twitter': case 'facebook':
				return Socialize::driver(strtolower($provider))->redirect();
				break;
			default:
				// ------------------------------------------------------------------------------------------------------------
				// SHOW DISPLAY
				// ------------------------------------------------------------------------------------------------------------
				$this->layout->page = view($this->page_base_dir . 'login');
				return $this->layout;
				break;
		}
	}


	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function login_callback($provider)
	{
		switch (strtolower($provider)) {
			case 'facebook': case 'twitter':
				$user_sso = Socialize::driver(strtolower($provider))->user();
				if (str_is(strtolower($provider), 'facebook'))
				{
					$result = $this->dispatch(new CreateMemberFromFacebook($user_sso));
				}
				else
				{
					$result = $this->dispatch(new CreateMemberFromTwitter($user_sso));
				}

				if ($result['status'] == 'success')
				{
					Auth::login($result['data']['data']);
					return redirect()->route('web.home');
				}
				else
				{
					return redirect()->route('web.login')->withErrors($result['data']['message']);
				}

				break;
			
			default:
				App::abort(404);
				break;
		}

	}

	public function login_post()
	{
		$email = Input::get('email');
		$password = Input::get('password');

		// find user
		$user = User::findEmail($email)->first();

		//
		if ($user) // login
		{
			Auth::login($user);
			return redirect()->intended('web.me');
		}
		else // register
		{
			$user = new User;
			$user->name = $email;
			$user->email = $email;
			$user->password = $password;

			if (!$user->save())
			{
				return redirect()->back()->withInput()->withErrors($user->getErrors());
			}
			else
			{
				Auth::login($user);
				return redirect()->route('web.me.profile.edit');
			}
		}
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->back();
	}
}