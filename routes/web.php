<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get("/login",function (){
    return "I am login.";
});

Route::group(["prefix"=>"account","middleware"=>["web"]],function (){

    //使用facade进行数据的增删改查
    Route::any("/","AccountController@index");

    Route::any("/select","AccountController@index");
    Route::any("/add","AccountController@add");
    Route::any("/update/{id}","AccountController@update");
    Route::any("/delete/{id}","AccountController@delete");

    //查询构造器操作
    Route::any("/querySelect","AccountController@querySelect");
    Route::any("/queryAdd","AccountController@queryAdd");
    Route::any("/queryUpdate/{id}","AccountController@queryUpdate");
    Route::any("/queryDelete/{id}","AccountController@queryDelete");

    //ORM操作
    Route::any("/orm","AccountController@orm");
    Route::any("/ormAdd","AccountController@ormAdd");
    Route::any("/ormUpdate","AccountController@ormUpdate");
    Route::any("/ormDelete","AccountController@ormDelete");

    //视图演示
    Route::any("/view1","AccountController@view1");

    //url测试
    Route::any("/url",["as"=>"url","uses"=>"AccountController@urlTest"]);

    //请求演示
    Route::any("/request",["as"=>"request","uses"=>"AccountController@request1"]);

    //session会话演示
    Route::any("/session1",["as"=>"session1","uses"=>"AccountController@session1"]);
    Route::any("/session2",["as"=>"session2","uses"=>"AccountController@session2"]);

    //响应
    Route::any("/response",["as"=>"response","uses"=>"AccountController@response"]);
    Route::any("/responsePage",["as"=>"responsePage","uses"=>"AccountController@responsePage"]);

    //中间件演示
    Route::any("/activity0",["as"=>"activity0","uses"=>"AccountController@activity0"]);
    Route::group(["middleware" => ["activity"]],function (){
        Route::any("/activity1",["as"=>"activity1","uses"=>"AccountController@activity1"]);
        Route::any("/activity2",["as"=>"activity2","uses"=>"AccountController@activity2"]);
    });

    //与前端页面进行交互
    Route::any("/record.data","AccountController@record");      //获取记录
    Route::any("/create","AccountController@create"); //创建页面与添加数据请求
    Route::any("/del","AccountController@del");     //前端控制删除
    Route::any("/modify/{id}","AccountController@modify");     //前端控制修改
    Route::any("/detail/{id}","AccountController@detail");     //前端控制详情

});


Route::get("/layout",function (){
    return view("common.layout");
});

Route::get("/test",["as"=>"/test","uses"=>"TestController@index"]);


//网站整体路由
Route::group(["middleware"=>["web"]],function (){

    Route::get("/",["as"=>"/","uses"=>"PatientInfoController@index"]);
    Route::get("/index",["as"=>"index","uses"=>"PatientInfoController@index"]);
    Route::any("/option/{clazz}/{name}/{key?}",["uses"=>"AdminController@option"]);

    Route::group(["prefix"=>"patient"],function (){
        Route::get("/",["uses"=>"PatientInfoController@index"]);
        Route::any("/record.data",["uses"=>"PatientInfoController@record"]);
        Route::any("/create","PatientInfoController@create");            //创建页面与添加数据请求
        Route::any("/delete","PatientInfoController@delete");            //前端控制删除
        Route::any("/update/{id}","PatientInfoController@update");       //前端控制修改
        Route::any("/detail/{id}","PatientInfoController@detail");       //前端控制详情
    });

    Route::group(["prefix"=>"family"],function (){
        Route::any("/","FamilyHistoryController@index");                            //创建页面与添加数据请求
        Route::any("/create","FamilyHistoryController@create");                     //创建页面与添加数据请求
        Route::any("/option/{name}/{key?}","FamilyHistoryController@option");       //创建页面与添加数据请求
    });

    Route::group(["prefix"=>"sd"],function (){
        Route::any("/","SmokeDrinkController@index");                                   //创建页面与添加数据请求
        Route::any("/create","SmokeDrinkController@create");                            //创建页面与添加数据请求
        Route::any("/option/{name}/{key?}","SmokeDrinkController@option");           //创建页面与添加数据请求
    });

    Route::group(["prefix"=>"hypertension"],function (){
        Route::any("/","HypertensionController@index");                                   //创建页面与添加数据请求
        Route::any("/create","HypertensionController@create");                            //创建页面与添加数据请求
        Route::any("/option/{name}/{key?}","HypertensionController@option");           //创建页面与添加数据请求
    });



});

