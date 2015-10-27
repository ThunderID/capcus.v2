<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class RegisterSubscriber extends Job implements SelfHandling
{
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($email)
	{
		//
		$this->email = $email;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// check if data exists in subscription
		$subscriber = \App\Subscriber::findEmail($this->email)->first();
		
		// check if data exists in user
		if (!$subscriber)
		{
			$user = \App\User::FindEmail($this->email)->first();

			$subscriber = new \App\Subscriber;
			if ($user->email)
			{
				$subscriber->email = $user->email;
				$subscriber->user_id = $user->id;
			}
			else
			{
				$subscriber->email = $this->email;
			}
			$subscriber->is_subscribe = true;
			// add to subscription
			if (!$subscriber->save())
			{
				$jsend = new \ThunderID\jsend\jsend('fail', ['data' => $subscriber->getErrors()->toArray()]);
			}
			else
			{
				$jsend = new \ThunderID\jsend\jsend('success', ['data' => $subscriber]);
			}
		}
		else
		{
			$jsend = new \ThunderID\jsend\jsend('success', ['data' => $subscriber]);
		}

		return $jsend->toArray();
	}
}
