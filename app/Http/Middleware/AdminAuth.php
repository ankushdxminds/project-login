<?php



namespace App\Http\Middleware;



use Closure;

Use Auth;

Use Redirect;



class AdminAuth

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
        if(!Auth::check())
        {
           return redirect(url('/login'));
        }
     
      return $next($request);

    }

}

