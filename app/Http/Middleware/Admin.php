<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        // if (\Auth::guard('admin')->check()) {
        //     return redirect()->route('admin-home');
        // }
        // return $next($request);

        if ( !auth()->guard('admin')->check() ) {
            // return route('home');
            // return redirect('behindthecurtain/login');     
            return redirect()->route('admin-home');
   
        }
        $response = $next($request);
        // if(url()->current() == url('/behindthecurtain/export')){
        //     return $response;   
        // }
        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    }
}
