<?php namespace App\Http\Controllers\Web;

use Auth, Input, \Illuminate\Support\MessageBag;
use \App\EmailSubscription;
use \App\Jobs\RegisterSubscriber;
use \App\Jobs\UnregisterSubscriber;

use Hash;

class SubscriptionController extends Controller {

	public function add()
	{
		$email = Input::get('email');
		$command_result = $this->dispatch( new RegisterSubscriber($email));
		if ($command_result['status'] == 'fail')
		{
			return redirect()->route('web.subscription.fail', ['email' => $email])->withInput()->withErrors($command_result['data']['data']);
		}
		else
		{
			return redirect()->route('web.subscription.success', ['id' => $command_result['data']['data']->id]);
		}
	}

	public function success($id)
	{
		$subscriber = \App\Subscriber::find($id);
		if (!$subscriber)
		{
			App::abort(404);
		}

		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'subscription_successful');
		$this->layout->page->subscriber 	= $subscriber;

		return $this->layout;
	}

	public function unsubscribe($id, $token)
	{
		$result = $this->dispatch(new UnregisterSubscriber($id, $token));
		if ($result['status'] == 'fail')
		{
			App::abort(404);
		}
		
		// ------------------------------------------------------------------------------------------------------------
		// SHOW DISPLAY
		// ------------------------------------------------------------------------------------------------------------
		$this->layout->page = view($this->page_base_dir . 'unsubscription_successful');
		$this->layout->page->subscriber 	= $result['data']['data'];

		return $this->layout;
	}
}