<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CompanyAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       if( Auth::check() )
        {
            // if user is not admin take him to his dashboard
            if ( Auth::user()->isUser() ) {
                 return redirect(route('user_dashboard'));
            }
            else if( Auth::user()->isAdmin()){
                 return redirect(route('admin_dashboard'));   
            }
            else if ( Auth::user()->isCompany() ) {
                 return $next($request);
            }
        }

        abort(404);  // for other user throw 404 error
    }
}
