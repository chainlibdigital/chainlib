<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class FrontAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Auth::guard('persons')->guest()){
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(Request::segment(1).'/login');
            }
        }

        return $next($request);
    }
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

