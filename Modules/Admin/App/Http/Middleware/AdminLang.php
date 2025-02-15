<?php

namespace Modules\Admin\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLang
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(!\Cookie::get('admin_lang')) {
            app()->setLocale('ar');
        }else {
            app()->setLocale(\Cookie::get('admin_lang'));
        }
        return $next($request);
    }
}
