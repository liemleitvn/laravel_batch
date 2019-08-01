<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Auth\AuthenticationException;
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
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        if($request->isJson()) {

            if($e instanceof ModelNotFoundException) {
                return response()->json([
                    'data' => (object)[],
                    'error' => 'Resource not found',
                    'status_code' => Response::HTTP_NOT_FOUND

                ], Response::HTTP_NOT_FOUND);
            }
            if($e instanceof NotFoundHttpException) {
                return response()->json([
                    'data' => (object)[],
                    'error' => 'Endpoint not found',
                    'status_code' => Response::HTTP_NOT_FOUND
                ], Response::HTTP_NOT_FOUND);
            }
            return response()->json([
                'data' => (object)[],
                'error' => $e->getMessage(),
                'status_code' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }

        if($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                case 401:
                    return response()->view('errors.401', ['message' => $e->getMessage()]);
                    break;
                case 403:
                    return response()->view('errors.403',['message' => $e->getMessage()]);
                    break;
                case 404:
                    response()->view('errors.404',['message' => $e->getMessage()]);
                    break;
            }
        }

        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }

}
