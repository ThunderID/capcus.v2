<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

use \App\User;

class CreateMemberFromFacebook extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sso_data)
    {
        $this->sso_data = $sso_data;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //------------------------------------------
        // Check if user from facebook already exists
        //------------------------------------------
        $user = User::FacebookId($this->sso_data->id)->first();

        //------------------------------------------
        // Check if user with same email already exists
        //------------------------------------------
        if (!$user)
        {
            $user = User::FindEmail($this->sso_data->email)->first();
        }

        //------------------------------------------
        // Create/Update user
        //------------------------------------------
        if (!$user)
        {
            $user = new User;
            $user->name     = $this->sso_data->name;
            $user->email    = $this->sso_data->email;
            $user->avatar   = $this->sso_data->avatar;
            $user->password = str_random(100);
            $user->is_admin = 0;

            $user->sso_twitter_id = '';
            $user->sso_twitter_data = '';
            $user->sso_twitter_updated_at = null;
        }
        else
        {
            $user->email    = $this->sso_data->email;
            $user->avatar   = $this->sso_data->avatar;
        }

        $user->sso_facebook_id          = $this->sso_data->id;
        $user->sso_facebook_data        = json_encode((array)$this->sso_data);
        $user->sso_facebook_updated_at  = \Carbon\Carbon::now();

        //------------------------------------------
        // Return data
        //------------------------------------------
        if ($user->save())
        {
            $jsend = new \ThunderID\jsend\jsend('success', ['data' => $user]);
        }
        else
        {
            $jsend = new \ThunderID\jsend\jsend('fail', ['message' => $user->getErrors()]);
        }
        return $jsend->toArray();
    }
}
