<?php

namespace App\Exceptions;

use Exception;
use Flash;

use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    /*public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }*/

    public function render($request, Exception $e)
    {
        if($e instanceof \Cartalyst\Sentinel\Checkpoints\ThrottlingException)
        {
            Flash::error($e->getMessage());
            return redirect()->back();
        }


        if(env('APP_ENV','local') != 'local')
        {
            if($e instanceof Exception)
            {
                parent::report($e);
                Meta::setTitle('404 Page Not Found ');

                return response()->view('errors.404',[],404);
            }
        }

        if ($e instanceof TokenMismatchException)
        {

            Flash::error("Opps! Seems you couldn't submit form for a longtime. Please try again and reload page before submitting form.");
            return redirect(url('/')."/patient/error");
        }

        return parent::render($request, $e);
    }

}
