<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (config('backend.primary_language')) {
            $language = config('backend.primary_language');
        }

        if (isset($language)) {
            app()->setLocale($language);
        }

        return $next($request);

//        if (session()->has('locale')) {
//            App::setLocale(session()->get('locale'));
//        }
//
//        return $next($request);
    }
}
