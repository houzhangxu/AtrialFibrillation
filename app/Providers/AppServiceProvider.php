<?php

namespace App\Providers;

use App\ModelManger;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $model = new ModelManger();
        $tree = $model->getTree();

        $sideID = ModelManger::where("route",Request::getPathInfo())->first();

        if($sideID == null){
            $sideID = 0;
        }
        View::share("sideID",$sideID["pid"]);
        View::share("modelSide",$tree);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
