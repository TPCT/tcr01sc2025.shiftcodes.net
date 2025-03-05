<?php

namespace Modules\Website\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;
class Language
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {

// Get the first URL segment (the language part)
        $locale = $request->segment(1);

        // // Check if the locale is valid
        // if (in_array($locale, ['en', 'ar', 'ru'])) {
        //     App::setLocale($locale);  // Set Laravel's locale
        //     setlocale(LC_ALL, $locale . '.UTF-8');  // Correct use of setlocale
        // } else {
        //     App::setLocale('en');  // Default to 'en' if the language is not valid
        //     setlocale(LC_ALL, 'en_US.UTF-8');  // Default locale setting
        // }
        // if(\Cookie::get('locale')) {
        //     app()->setLocale(\Cookie::get('locale'));
        // }else {
        //     app()->setLocale('en');
        // }
        // dd(app()->getLocale());

        if(auth()->guard('customers')->check()) {
            if(!auth()->guard('customers')->user()->is_phone_verified 
            && \Route::currentRouteName() != 'verify' && \Route::currentRouteName() != 'phone'
            && \Route::currentRouteName() != 'logout'
            ) {
                return redirect()->route('website.account.phone');
            }
        }

        \App\Models\View::create([
            'car_id' =>null,
            'company_id' => null,
            'user_id' => null
        ]);
        
        return $next($request);
    }
}
