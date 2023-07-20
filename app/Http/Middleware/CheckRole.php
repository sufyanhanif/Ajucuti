<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        //jika akun yang login sesuai dengan role 
        //maka silahkan akses
        //jika tidak sesuai akan diarahkan ke home
    
        $roles = array_slice(func_get_args(), 2);
    
        foreach ($roles as $role) { 
            $user = Auth::user()->role;
            if( $user == $role){
                return $next($request);
            }
        }
    
        return redirect('user/ajucuti')->with('status','Access Denied. As you are not Admin');;
    }
}
