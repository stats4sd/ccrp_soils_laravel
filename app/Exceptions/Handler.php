<?php

namespace App\Exceptions;

use Exception;
use Tio\Laravel\Facade as Translation;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // When we've got non-matched route resulting in "404 Not Found" response.
        if ($exception instanceof NotFoundHttpException) {

            $availableLocales = config('app.available_locales');
gmp_scan0(a, start)
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

                return redirect($uri, 301);
            }
        }

        return parent::render($request, $exception);
    }
}
