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
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}





:where('user_id', $userdata['user_id'])->get();
        return $data;
    }

    public function addSetToWish(Request $request)
    {
        $userdata = $this->checkIfLogged();

        $wishSet = WishListSet::where('set_id', $request->get('setId'))->where('user_id', $userdata['user_id'])->first();

        if (is_null($wishSet)) {
            WishListSet::create([
                'set_id' => $request->get('setId'),
                'user_id' => $userdata['user_id'],
            ]);
        }

        return $this->getWishItems();
    }


    /**
     *  private method
     *  Check if user is logged
     */
    private function checkIfLogged() {
        if(auth('persons')->guest()) {
            return array('is_logged' => 0, 'user_id' => $_COOKIE['user_id']);
        } else {
            return array('is_logged' => 1, 'user_id' => auth('persons')->id());
        }
    }
}
