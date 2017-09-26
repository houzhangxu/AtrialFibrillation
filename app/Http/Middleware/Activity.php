<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/6
 * Time: 13:00
 */

namespace App\Http\Middleware;

use Closure;

class Activity
{
    /*
     * 前置操作
    public function handle($request,Closure $next){
        if(time() < strtotime("2017-09-06")){
            return redirect()->route("activity0");
        }

        return $next($request);
    }
    */

    //后置操作
    public function handle($request,Closure $next){
        $response = $next($request);
        dump($response);
        return $response;
    }

}