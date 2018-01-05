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
Route::get("/login",["as"=>"login","uses"=>"Auth\LoginController@login"]);

Route::group(["middleware"=>["web","auth"]],function (){

    Route::get("/",["as"=>"/","uses"=>"PatientInfoController@index"]);
    Route::get('/home', 'PatientInfoController@index')->name('home');
    Route::get("/index",["as"=>"index","uses"=>"PatientInfoController@index"]);
    Route::any("/option/{clazz}/{name}/{key?}",["uses"=>"AdminController@option"]);

    Route::group(["prefix"=>"patient"],function (){     //病人信息
        Route::get("/",["uses"=>"PatientInfoController@index"]);
        Route::any("/record.data",["uses"=>"PatientInfoController@record"]);
        Route::any("/create","PatientInfoController@create")->middleware("permission:最高权限|普通权限|新增病人");            //创建页面与添加数据请求
        Route::any("/delete","PatientInfoController@delete")->middleware("permission:最高权限|普通权限|删除病人");            //前端控制删除
        Route::any("/update/{id}","PatientInfoController@update")->middleware("permission:最高权限|普通权限|修改病人");       //前端控制修改
        Route::any("/detail/{id}","PatientInfoController@detail")->middleware("permission:最高权限|普通权限|浏览病人详细信息");       //前端控制详情
    });

    Route::group(["middleware"=>["permission:普通权限|病人信息二级页面"]],function (){

    //家庭史
    Route::group(["prefix"=>"family"],function (){
        Route::any("/","FamilyHistoryController@index");                            //创建页面与添加数据请求
        Route::any("/create","FamilyHistoryController@create");                     //创建页面与添加数据请求
        Route::any("/option/{name}/{key?}","FamilyHistoryController@option");       //创建页面与添加数据请求
    });

    //抽烟喝酒
    Route::group(["prefix"=>"sd"],function (){
        Route::any("/","SmokeDrinkController@index");
        Route::any("/create","SmokeDrinkController@create");
        Route::any("/option/{name}/{key?}","SmokeDrinkController@option");
    });

    //高血压
    Route::group(["prefix"=>"hypertension"],function (){
        Route::any("/","HypertensionController@index");
        Route::any("/create","HypertensionController@create");
        Route::any("/option/{name}/{key?}","HypertensionController@option");

        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","HypertensionController@measure");
            Route::any("/create","HypertensionController@measureCreate");
            Route::any("/update/{id}","HypertensionController@measureUpdate");
            Route::any("/delete","HypertensionController@measureDelete");
        });

    });

    //冠心病
    Route::group(["prefix"=>"CoronaryHeartDisease"],function (){
        Route::any("/","CoronaryHeartDiseaseController@index");
        Route::any("/create","CoronaryHeartDiseaseController@create");
        Route::any("/option/{name}/{key?}","CoronaryHeartDiseaseController@option");
    });

    //脑卒中
    Route::group(["prefix"=>"CerebralApoplexy"],function (){
        Route::any("/","CerebralApoplexyController@index");
        Route::any("/create","CerebralApoplexyController@create");
        Route::any("/option/{name}/{key?}","CerebralApoplexyController@option");
    });

    //抗凝方案
    Route::group(["prefix"=>"AnticoagulantRegimen"],function (){
        Route::any("/","AnticoagulantRegimenController@index");
        Route::any("/create","AnticoagulantRegimenController@create");
        Route::any("/option/{name}/{key?}","AnticoagulantRegimenController@option");
    });

    //心律失常药物
    Route::group(["prefix"=>"ArrhythmicDrugs"],function (){
        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","ArrhythmicDrugsController@measure");
            Route::any("/create","ArrhythmicDrugsController@measureCreate");
            Route::any("/update/{id}","ArrhythmicDrugsController@measureUpdate");
            Route::any("/delete","ArrhythmicDrugsController@measureDelete");
        });

    });

    //房颤负荷
    Route::group(["prefix"=>"AtrialFibrillationBurden"],function (){
        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","AtrialFibrillationBurdenController@measure");
            Route::any("/create","AtrialFibrillationBurdenController@measureCreate");
            Route::any("/update/{id}","AtrialFibrillationBurdenController@measureUpdate");
            Route::any("/delete","AtrialFibrillationBurdenController@measureDelete");
        });

    });

    //肾功能不全
    Route::group(["prefix"=>"RenalInadequacy"],function (){
        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","RenalInadequacyController@measure");
            Route::any("/create","RenalInadequacyController@measureCreate");
            Route::any("/update/{id}","RenalInadequacyController@measureUpdate");
            Route::any("/delete","RenalInadequacyController@measureDelete");
        });

    });

    //甲状腺功能
    Route::group(["prefix"=>"ThyroidFunction"],function (){
        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","ThyroidFunctionController@measure");
            Route::any("/create","ThyroidFunctionController@measureCreate");
            Route::any("/update/{id}","ThyroidFunctionController@measureUpdate");
            Route::any("/delete","ThyroidFunctionController@measureDelete");
        });

    });

    //肝功能不全
    Route::group(["prefix"=>"HepaticInsufficiency"],function (){
        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","HepaticInsufficiencyController@measure");
            Route::any("/create","HepaticInsufficiencyController@measureCreate");
            Route::any("/update/{id}","HepaticInsufficiencyController@measureUpdate");
            Route::any("/delete","HepaticInsufficiencyController@measureDelete");
        });

    });

    //血脂
    Route::group(["prefix"=>"BloodFat"],function (){
        //随访页面
        Route::group(["prefix"=>"measure"],function (){
            Route::any("/","BloodFatController@measure");
            Route::any("/create","BloodFatController@measureCreate");
            Route::any("/update/{id}","BloodFatController@measureUpdate");
            Route::any("/delete","BloodFatController@measureDelete");
        });

    });

    //糖尿病
    Route::group(["prefix"=>"Diabetes"],function (){
        Route::any("/","DiabetesController@index");
        Route::any("/create","DiabetesController@create");
        Route::any("/option/{name}/{key?}","DiabetesController@option");
    });

    //生殖激素
    Route::group(["prefix"=>"ReproductiveHormone"],function (){
        Route::any("/","ReproductiveHormoneController@index");
        Route::any("/create","ReproductiveHormoneController@create");
        Route::any("/option/{name}/{key?}","ReproductiveHormoneController@option");
    });

    //BNP
    Route::group(["prefix"=>"BNP"],function (){
        Route::any("/","BNPController@index");
        Route::any("/create","BNPController@create");
        Route::any("/option/{name}/{key?}","BNPController@option");
    });

    //手术参数
    Route::group(["prefix"=>"Operation"],function (){
        Route::any("/","OperationController@index");
        Route::any("/create","OperationController@create");
        Route::any("/option/{name}/{key?}","OperationController@option");
    });

    //住院费用
    Route::group(["prefix"=>"HospitalizationExpenses"],function (){
        Route::any("/","HospitalizationExpensesController@index");
        Route::any("/create","HospitalizationExpensesController@create");
        Route::any("/option/{name}/{key?}","HospitalizationExpensesController@option");
    });

    //房颤复发情况
    Route::group(["prefix"=>"Relapse"],function (){
        Route::any("/","RelapseController@index");
        Route::any("/create","RelapseController@create");
        Route::any("/option/{name}/{key?}","RelapseController@option");
    });

    });

    //Excel导入导出
    Route::any("import","ExcelController@import")->middleware("permission:最高权限|普通权限|导入");
    Route::any("importTest","ExcelController@importTest")->middleware("permission:最高权限|普通权限|导入");
    Route::any("importInsert","ExcelController@importInsert")->middleware("permission:最高权限|普通权限|导入");
    Route::get("export","ExcelController@export")->middleware("permission:最高权限|普通权限|导出");
    Route::get("export1","ExcelController@export1");
    Route::get("excelv","ExcelController@view");


    //测试权限
    Route::get("permission","AccountController@permission");


    //后台管理
    Route::group(["prefix"=>"admin","middleware"=>["role:超级管理员"]],function (){
        Route::any("/","Admin\AdminController@index")->name("admin");

        Route::group(["prefix"=>"user"],function (){    //用户管理
            Route::get("/","Admin\UserController@index")->name("admin.user.index");
            Route::any("/record.data",["uses"=>"Admin\UserController@record"]);
            Route::any("/create","Admin\UserController@create");
            Route::any("/update/{id}","Admin\UserController@update");
            Route::any("/detail/{id}","Admin\UserController@detail");
            Route::any("/reset/{id}","Admin\UserController@reset");
        });

        Route::group(["prefix"=>"role"],function (){    //角色管理
            Route::get("/","Admin\RoleController@index")->name("admin.role.index");
            Route::any("/record.data",["uses"=>"Admin\RoleController@record"]);
            Route::any("/create","Admin\RoleController@create");
            Route::any("/update/{id}","Admin\RoleController@update");
            Route::any("/detail/{id}","Admin\RoleController@detail");
            Route::any("/delete","Admin\RoleController@delete");
            Route::any("/list","Admin\RoleController@getAllRoles")->name("admin.role.list");
        });

        Route::group(["prefix"=>"permissions"],function (){    //权限管理
            Route::get("/","Admin\PermissionsController@index")->name("admin.permissions.index");
            Route::any("/record.data",["uses"=>"Admin\PermissionsController@record"]);
            Route::any("/create","Admin\PermissionsController@create");
            Route::any("/update/{id}","Admin\PermissionsController@update");
            Route::any("/detail/{id}","Admin\PermissionsController@detail");
            Route::any("/delete","Admin\PermissionsController@delete");
            Route::any("/list","Admin\PermissionsController@getAllPermissions")->name("admin.permissions.list");
        });

        Route::group(["prefix"=>"model"],function (){    //模块管理
            Route::get("/","Admin\ModelManagerController@index")->name("admin.model.index");
            Route::any("/record/{pid?}",["uses"=>"Admin\ModelManagerController@record"]);
            Route::any("/create/{pid?}","Admin\ModelManagerController@create");
            Route::any("/update/{id}","Admin\ModelManagerController@update");
            Route::any("/detail/{id}","Admin\ModelManagerController@detail");
            Route::any("/delete","Admin\ModelManagerController@delete");
            Route::any("/re","Admin\ModelManagerController@re");
            Route::any("/tree/{pid?}","Admin\ModelManagerController@getChildren");
            Route::any("/tree1/{pid?}","Admin\ModelManagerController@testTree");
        });

        Route::group(["prefix"=>"cae"],function (){    //中英文对照表
            Route::get("/","Admin\CAEController@index")->name("admin.cae.index");
            Route::any("/record.data",["uses"=>"Admin\CAEController@record"]);
            Route::any("/create","Admin\CAEController@create");
            Route::any("/update/{id}","Admin\CAEController@update");
            Route::any("/detail/{id}","Admin\CAEController@detail");
            Route::any("/delete","Admin\CAEController@delete");
        });

    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home1');

