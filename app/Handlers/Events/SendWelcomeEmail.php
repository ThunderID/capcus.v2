<?php

namespace App\Handlers\Events;

use App\Events\NewMemberRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendWelcomeEmail
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(NewMemberRegistered $event)
    {
        $user = $event->user;
        //
        Mail::queue('web.v4.emails.welcome_mail', ['user' => $user], function ($m) use ($user) {
            if ($user->email)
            {
                try {
                    $m->to($user->email, $user->name)->subject('Hi ' . $user->name . ' - Welcome to CAPCUS.id');
                } catch (\Exception $e) {
                    // dd($user->email);
                }
            }
        });
    }
}
