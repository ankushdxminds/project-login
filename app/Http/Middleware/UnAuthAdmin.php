<?php



namespace App\Http\Middleware;



use Closure;

use Auth;



class UnAuthAdmin

{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {

            $auth_user = Auth::user();



            if ($auth_user->id)

            {

                return redirect(url('admin/dashboard'));

            }

        }

        return $next($request);

    }

}

