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
		$subscription = \App\Subscribe::findEmail($this->email)->first();
		if (!$subscription)
		{
			// check if data exists in user
			$user = \App\User::FindEmail($this->email)->first();

			$subscription = new \App\Subscribe;
			if ($user->email)
			{
				$subscription->email = $user->email;
				$subscription->user_id = $user->id;
			}
		}

		// add to subscription
		$subscription->is_subscribe = true;
		if (!$subscription->save())
		{
			return false;
		}
		else
		{
			return $subscription;
		}
	}
}
