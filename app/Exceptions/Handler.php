<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Exceptions\PostTooLargeException;

class Handler extends ExceptionHandler
{

    /**
     * Render an exception into an HTTP response.
     *
     * @param $request
     * @param Throwable $exception
     * @return JsonResponse
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof PostTooLargeException) {

            return Redirect::back()->withErrors(['msg' => 'The Message']);
         }
     
         return parent::render($request, $exception);
    }
}
