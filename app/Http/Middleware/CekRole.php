<?php  
namespace App\Http\Middleware;  
use Closure;  
class CekRole 
{     
    public function handle($request, Closure $next, ...$role)     
    {        
         if (in_array(\Auth::user()->role, $role)){            
          return $next($request);           
                
    }        
    return redirect('/');
} 
}