<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag;
use \App\EmailSubscription;
use \App\Jobs\SubscribeNewsletter;

class SubscriptionController extends Controller {

	public function add()
	{
		$email = Input::get('email');
		$command_result = $this->dispatch( new SubscribeNewsletter($email));
		if ($command_result == 'fail')
		{
			return redirect()->route('web.subscription.fail', ['email' => $email])->withInput()->withErrors();
		}
		else
		{
			return redirect()->route('web.subscription.success', ['email' => $email]);
		}
	}

	public function success($email)
	{
		$this->layout->page = view('web.pages.subscription.success')->with('email', $email);

		return $this->layout;
	}

	public function fail($email)
	{
		$this->layout->page = view('web.pages.subscription.fail')->with('email', $email);

		return $this->layout;
	}
}