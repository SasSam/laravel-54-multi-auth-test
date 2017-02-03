<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // if ($request->expectsJson()) {
        //     return response()->json(['error' => 'Unauthenticated.'], 401);
        // }

        // return redirect()->guest('login');

        // https://laravel.io/forum/09-01-2016-laravel-53-auth-redirect-guests-based-on-guard
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // Customize the redirect based on the guard
        // Note that we don't know which guard failed here, but I can't find an elegant way
        // to handle this and I know in this project I am only using one guard at a time anyway.
        // $middleware = request()->route()->gatherMiddleware();
        // $guard = config('auth.defaults.guard');
        // foreach ($middleware as $m) {
        //     if (preg_match("/auth:/", $m)) {
        //         list($mid, $guard) = explode(":", $m);
        //     }
        // }

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'customer':
                $login = route('customer.login');
                break;
            case 'employee':
                $login = route('employee.login');
                break;
            default:
                $login = '/';
                break;
        }

        return redirect()->guest($login);
    }
}
