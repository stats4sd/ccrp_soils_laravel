<?php

namespace App\Http\Middleware;

use Closure;

class SetLocaleMiddleware
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

        $availableLocales = config('app.available_locales');

        if(
            $request->segment(1) !== "admin" &&
            $request->segment(1) !== "telescope" &&
            !array_key_exists($request->segment(1), $availableLocales)) {
            # based on the Tio set.locale middleware
            # Choose the most appropriate "default locale"
            $priorityLocales = [
                session('locale'),
                $request->getPreferredLanguage($availableLocales),
                config('app.locale'),
            ];
            # Keep the locales included in $availableLocales
            $eligibleLocales = array_filter($priorityLocales, function($locale) use ($availableLocales) {
                return in_array($locale, $availableLocales);
            });

            $default_locale = reset($eligibleLocales);

            // See if locale in url is absent or isn't among known languages.
            if (!\in_array($request->segment(1), $availableLocales)) {
                // Redirect to same url with default locale prepended.
                $uri = $request->getUriForPath('/' . $default_locale . $request->getPathInfo());

                return redirect($uri, 302);
            }
        }

        return $next($request);
    }
}
