<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
    public function render($request, Exception $exception)
    {
        if (config('app.debug')) {
            return parent::render($request, $exception);
        } else {
            $view = 'errors.500';
            $status = $message = null;
            if ($this->isHttpException($exception)) {
                Log::info("isHttpException");
                $status = $exception->getStatusCode();
                $message = $exception->getMessage();
                Log::info("$status");
                Log::info("$message");
            }
            if ($status == null) {
                $status = 500;
                $message = "";
            }
            $msg = [
                'error' => $status,
                'message' => isset($message) ? $message : null,
            ];
            return response()->view($view, $msg, $status);
        }
    }
}
