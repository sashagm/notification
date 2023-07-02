<?php

namespace Sashagm\Notification\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
    public function handle($request, Closure $next)
    {
        if (!config('nf.check.active')) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user) {
            abort(403, 'У вас нет прав на отправку уведомлений');
        }

        $colum = config('nf.check.save_colum');
        $val = config('nf.check.save_value');

        if (!in_array($user->$colum, $val)) {
            abort(403, 'У вас нет прав на отправку уведомлений');
        }

        return $next($request);
    }
}
