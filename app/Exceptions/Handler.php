<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Exception;
use Request;
use Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Session;

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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->ajax())
        {
            return response([
                "message" => "Unauthenticated.",
                "data" => [],
            ],401);
        }

        // return redirect()->to('/dashboard');
        // displaying the meesage by setting the session 
        Session::flash('flash_message', 'Please Log in First');
        return redirect()->to('/');

    }


// protected function unauthenticated($request, AuthenticationException $exception)
//     {

// if ($this->auth->guest())
//         {
//             if ($request->ajax())
//             {
//                 return response('Unauthorized.', 401);
//             }
//             else
//             {
//                 return redirect()->guest('/dashboard'); // <--- note this
//             }
//         }

//         return $next($request);
//     }
// }

//     protected function unauthenticated($request, AuthenticationException $exception)
// {
//     return $request->expectsJson()
//                 ? response()->json(['message' => $exception->getMessage()], 401)
//                 : redirect()->guest(route('login'));
// }
 // protected function unauthenticated($request, AuthenticationException $exception)
 //         {
 //            return $request->expectsJson()
 //                    ? response()->json(['message' => 'Unauthenticated.'], 401)
 //                    : redirect()->guest(route('dashboard'));

 //    }


}
