<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        return parent::render($request, $exception);
        // return response()->json(["code" => 401], 401);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // return $request->expectsJson()
        //             ? response()->json(['code' => 401], 401)
        //             : redirect()->guest(route('login'));

        return $request->expectsJson()
                    ? response()->json(['code' => 401], 401)
                    : redirect()->guest(route('login'));
    }

    // public function render($request, Throwable $exception)
    // {
    //     return response()->json(
    //         [
    //             'errors' => [
    //                 'status' => 401,
    //                 'message' => 'Unauthenticated',
    //             ]
    //         ], 401
    //     );
    // }

    

    
}
