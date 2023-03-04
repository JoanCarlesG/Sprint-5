<?php 
namespace App\Http\Middleware;


use Closure;

class CheckAdminRole
{
    protected function handle($request, Closure $next)
    {
        if ($request->user()->hasRole('Admin')) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}

?>