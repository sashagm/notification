<?php

namespace  Sashagm\Notification\Traits;


use Exception;


trait BootTrait
{
    public function bootSys()
    {
        
        $this->app['router']->aliasMiddleware('check.access', \Sashagm\Notification\Http\Middleware\CheckAccess::class);

    }

}