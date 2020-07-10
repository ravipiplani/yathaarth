<?php

namespace App\Exceptions;

use App\ApiCode;
use Google\Cloud\Core\Exception\BadRequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'errors' => [
                    $exception->getMessage()
                ]
            ], ApiCode::DATA_NOT_FOUND);
        }

        if ($exception instanceof UnauthorizedException) {
            return response()->json([
                'errors' => [
                    $exception->getMessage()
                ]
            ], ApiCode::UNAUTHORIZED);
        }

        if ($exception instanceof BadRequestException) {
            return response()->json([
                'errors' => [
                    $exception->getMessage()
                ]
            ], ApiCode::BAD_REQUEST);
        }

        return parent::render($request, $exception);
    }
}