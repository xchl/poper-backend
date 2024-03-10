<?php
/**
 * Created by xuchengliang
 * Date: 2024/3/9 22:41
 */

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Redirect;
use SMartins\PassportMultiauth\Http\Middleware\MultiAuthenticate as BaseMultiAuthenticate;

class MultiAuthenticate extends BaseMultiAuthenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        if($request->get('guard')){
            config(['auth.defaults.guard' => $request->get('guard')]);
        }
        if($request->is(config('admin.auth.redirect_to')) || $request->is('auth/logout')){
            return $next($request);
        }else{
            return parent::handle($request,$next,...$guards);
        }
    }

}