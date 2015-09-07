<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class AuthenticateSuperadmin
{
        /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest() || $this->auth->getUser()->is_admin <= 1)
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->back()->withErrors('Unauthorized Access');
            }
        }

        return $next($request);
    }
}
