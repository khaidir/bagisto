<?php

namespace Webkul\User\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Webkul\User\Bouncer;
use Route;

class RedirectIfNotAdmin
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string|null  $guard
    * @return mixed
    */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (! Auth::guard($guard)->check()) {
            return redirect()->route('admin.session.create');
        }

        $this->checkIfAuthorized($request);

        return $next($request);
    }

    public function checkIfAuthorized($request)
    {
        $permissiontype = auth()->guard('admin')->user()->role->permission_type;
        if($permissiontype == 'all'){
            return true;
        } else {
            $acl = app('acl');
            dd($acl);
            if(isset($acl->roles[Route::currentRouteName()]))
                Bouncer::allow($acl->roles[Route::currentRouteName()]);
        }

    }
}