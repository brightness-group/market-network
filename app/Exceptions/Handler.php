<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        if (request()->expectsJson()) {
            $this->renderable(function (Throwable $e) {
                if ($e instanceof ValidationException) {
                } else {
                    return $this->handleException($e);
                }
            });
        }
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        if (!empty($exception->errors())) {
            foreach ($exception->errors() as $key => $value) {
                return response()->json([
                    'message' => $value[0],
                    'data' => [
                        'errors' => $exception->errors()
                    ],
                    'status' => $exception->status
                ], $exception->status);

            }
        }
        return response()->json([
            'message' => 'Validation errors found',
            'data' => [
                'errors' => $exception->errors()
            ],
            'status' => $exception->status
        ], $exception->status);
    }

    public function handleException(Throwable $e)
    {
        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();
            $defaultMessage = \Symfony\Component\HttpFoundation\Response::$statusTexts[$code];

            if (in_array($code, \Symfony\Component\HttpFoundation\Response::$statusTexts)) {
                $defaultMessage = \Symfony\Component\HttpFoundation\Response::$statusTexts[$code];
            }
            $message = $e->getMessage() == "" ? $defaultMessage : $e->getMessage();
            return $this->errorJsonResponse($message, $code);
        } else if ($e instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));
            return $this->errorJsonResponse("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        } else if ($e instanceof AuthorizationException) {
            return $this->errorJsonResponse($e->getMessage(), Response::HTTP_FORBIDDEN);
            // } else if ($e instanceof ValidationException) {
            //     $errors = $e->validator->errors()->getMessages();
            //     return $this->errorJsonResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else if ($e instanceof AuthenticationException) {
            return $this->errorJsonResponse($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        } else if ($e instanceof NotFoundHttpException) {
            return $this->errorJsonResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        } else {
            if (config('app.debug')) {
                return $this->errorJsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return $this->errorJsonResponse('Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function errorJsonResponse(
        $message = 'Error occured',
        $code = Response::HTTP_INTERNAL_SERVER_ERROR
    )
    {
        return response()->json([
            'message' => $message,
            'data' => [],
            'status' => $code
        ], $code);
    }
}
