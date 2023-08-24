<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
    public function render($request, Exception $e)
    {
    	//echo "<pre>";print_r($e);exit;
        //return parent::render($request, $exception);
        if(env('APP_ENV') == 'live'){
            if ($e instanceof HttpResponseException) {
                return $e->getResponse();
            } elseif ($e instanceof ModelNotFoundException) {
                $e = new NotFoundHttpException($e->getMessage(), $e);
            } elseif ($e instanceof AuthenticationException) {
                return $this->unauthenticated($request, $e);
            } elseif ($e instanceof AuthorizationException) {
                $e = new HttpException(403, $e->getMessage());
            } elseif ($e instanceof ValidationException && $e->getResponse()) {
                return $e->getResponse();
            }

            if ($this->isHttpException($e)) {
                echo 'send to custom 404 error page';exit;
                return response()->view('errors.'.'404');
                return $this->toIlluminateResponse($this->renderHttpException($e), $e);
            } else {
                echo 'send to custom 500 error page';exit;
                return response()->view('errors.'.'500');
                return $this->toIlluminateResponse($this->convertExceptionToResponse($e), $e);
            }
        }else{
            return parent::render($request, $e);
        }
    }
}
