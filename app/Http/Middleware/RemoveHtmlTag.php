<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class RemoveHtmlTag
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        $input = $request->except('product_information','additional_information','description');
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);
        });
        $request->merge($input);
        return $next($request);
    }
}
