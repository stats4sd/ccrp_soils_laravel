<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class SetLocaleMiddleware
{
    /**
    * Handle an incoming request and set the right locale depending on the
    * query, segment, session, browser, fallback_locale or source_locale
    * (in that order). Keep the current locale in session until change.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {

        $targetLocales = config('translation.target_locales');
        $sourceLocale = config('translation.source_locale');

        $availableLocales = array_merge($targetLocales, array($sourceLocale));

        # Ordered by preference
        $priorityLocales = [
            $request->query('locale'),
            $request->segment(1), # /en/
            session('locale'),
            $request->getPreferredLanguage($availableLocales),
            config('app.fallback_locale'),
            $sourceLocale
        ];



        # Keep the locales included in $availableLocales
        $eligibleLocales = array_filter($priorityLocales, function($locale) use ($availableLocales) {
            return in_array($locale, $availableLocales);
        });

        # Take first locale
        $locale = reset($eligibleLocales);

        # Store in session for next time
        session(['locale' => $locale]);

        //if(session()->get('locale') != $request->route()->locale) {

           $pathSegments = explode('/', $request->path());

            if($request->query('locale') != session()->get('locale')) {

                if( count($pathSegments) == 0 || ! in_array($pathSegments[0], $availableLocales) ) {

                    $path = array_prepend($pathSegments, $locale);

                    return redirect(url(implode('/', $path)));
                }
            }


        //}


        # Set Locale for Gettext and Laravel PHP
        Translation::setLocale($locale);

        //dd($request);
        // if($request->segment(1) != $locale) {
        //     return redirect('en/' . $request->uri);
        // }

        return $next($request);
    }
}
