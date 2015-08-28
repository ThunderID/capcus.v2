<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use Hash;

class UnregisterSubscriber extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $token)
    {
        //
        $this->id = $id;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // check if data exists in subscription
        $subscriber = \App\Subscriber::find($this->id);
        
        // check if data exists in user
        if (!$subscriber)
        {
            $jsend = new \ThunderID\jsend\jsend('fail', ['data' => 'Email belum terdaftar sebagai pelanggan newsletter capcus']);
        }
        else
        {
            if (Hash::check($subscriber->email, $this->token))
            {
                $subscriber->is_subscribe = 0;
                $subscriber->save();
                $jsend = new \ThunderID\jsend\jsend('success', ['data' => $subscriber]);
            }
            else
            {
                $jsend = new \ThunderID\jsend\jsend('fail', ['data' => 'Token salah']);
            }
        }
        return $jsend->toArray();
    }
}
