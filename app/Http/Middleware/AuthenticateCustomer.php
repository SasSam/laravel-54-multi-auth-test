<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // https://laracasts.com/discuss/channels/general-discussion/can-you-add-parameters-to-middleware/replies/28867
        //        $_guard = $request->route()->getAction()['guard'];
        //        $guard = (empty($_guard) ? $guard : $_guard);

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }

            return redirect()->route('customer.login');
        }

        return $next($request);
    }
}
