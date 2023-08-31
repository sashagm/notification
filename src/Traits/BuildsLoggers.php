<?php

namespace  Sashagm\Notification\Traits;

use Illuminate\Support\Facades\Log;


trait BuildsLoggers
{


    public function logger($method, $mess)
    {


        $view =  config('nf.logger_method');
        
        switch ($view) {
            case true:

                Log::$method($mess);

                break;

            case false:

                $logFilePath = storage_path(config('nf.logger_path'));
                $logger = Log::build([
                    'driver' => 'single',
                    'path' => $logFilePath,
                    'level' => 'debug',
                ]);
                $logger->$method($mess);
        
                break;

            default:
                
                break;
        }

        
    }



}

