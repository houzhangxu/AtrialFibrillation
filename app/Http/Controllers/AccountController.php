<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/4
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Account;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AccountController extends Controller
{

    public function index(){
        $sex = (new Account())->sex();
        return view("account.index",[
            "sex"=>$sex
        ]);
    }

    public function record(Request $request){

        $sortCols = ["username","password","sex","created_at","updated_at"];

        $where = "1=1 ";
        $whereArray = [];

        $pageStart = $request->input("iDisplayStart",0);        //开始页码,默认为0
        $pageSize = $request->input("iDisplayLength",5);        //单页显示条数,默认为5

        //表格全局搜索条件
        if($request->has("sSearch") && $request->input("sSearch")!=""){
            $where .= "and (username like ? or sex like ? ) ";   //SQL语句 对username字段进行模糊查询
            $whereArray[] = "%".$request->input("sSearch")."%"; //添加对应查询条件的值
            $whereArray[] = "%".$request->input("sSearch")."%"; //添加对应查询条件的值
        }

        $accounts = Account::whereRaw($where,$whereArray)
            ->orderBy($sortCols[$request->input("iSortCol_0",0)],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();

        $count = Account::whereRaw($where,$whereArray)
            ->count();  //获取一共查询到多少条记录

        //$sortCol = $request->input("sSortDir_0");

        $data["sEcho"] = $request->input("sEcho","");
        $data["iTotalDisplayRecords"] = $count;
        $data["iTotalRecords"] = count($accounts);
        $data["aaData"] = $accounts;
        return $data;
    }

    /**
     * facade查询数据
     */
    public function select(){
        $result = Account::selectData();  //返回查询结果 数组
        dump($result);
        //return Account::hello();
    }

    /**
     * facade添加数据
     */
    public function add(){
        $result = Account::addData();   //返回新增结果
        dump($result);
    }

    /**
     * facade修改数据
     */
    public function update($id){
        $result = Account::updateData($id);  //返回受影响行数
        dump($result);
    }

    /**
     * facade删除数据
     */
    public function delete($id){
        $result = Account::deleteData($id); //返回受影响行数
        dump($result);
    }

    /**
     * 查询构造器查询数据
     */
    public function querySelect(){
        $result = Account::querySelect();  //返回查询结果 数组
        dump($result);
    }

    /**
     * 查询构造器添加数据
     */
    public function queryAdd(){
        $result = Account::queryAdd();     //返回插入数据的ID
        dump($result);
    }

    /**
     * 查询构造器修改数据
     */
    public function queryUpdate($id){
        $result = Account::queryUpdate($id);  //返回受影响行数
        dump($result);
    }

    /**
     * 查询构造器删除数据
     */
    public function queryDelete($id){
        $result = Account::queryDelete($id);
        dump($result);
    }

    /**
     * ORM查询操作
     */
    public function orm(){
        //$accounts = Account::all();       //查询表中所有数据,返回的是对象的集合

        //$account = Account::find(1);      //查询表中对应主键的数据,返回单个对象
        //$account = Account::findOrFail(10);      //查询表中对应主键的数据,成功返回单个对象,不成功则报错

        /*
        $account = Account::where("id",">","1")
            ->orderBy("id","desc")
            ->first();
        //查询首条记录,返回单个对象
        */

        //$accounts = Account::where("id",">","1")->get();  //查询数据,返回对象的集合

        $account = Account::orderBy("id","desc")->first();  //查询数据,返回对象的集合
        echo $account->updated_at;

        /*
        Account::chunk(2,function ($accounts){
            dump($accounts);
        });
        //分段操作
        */


        //聚合函数的用法同理

        dump($account);
    }

    /**
     * ORM添加操作
     */
    public function ormAdd(){

        /*
         * 第一种添加方式
        $account = new Account();       //实例化类
        $account->username = "ormadd";  //对属性赋值
        $account->password = "123456";  //对属性赋值
        $account->sex = 0;              //对属性赋值

        $result = $account->save();     //调用保存方法
        dump($result);
        */

        $account = Account::create(
            ["username"=>"pl2","password"=>"123456","sex"=>0]
        );
        //在进行批量赋值的时候,必须在模型类中定义好可以批量添加的字段

        /*
        $account = Account::firstOrCreate(
            ["username"=>"pl2","password"=>"123456","sex"=>0]
        );
        //如果有这条数据,就取出,没有则添加
        */

        /*
        $account = Account::firstOrNew(
            ["username"=>"pl6","password"=>"123456","sex"=>0]
        );
        $account->save();
        */
        //如果有数据,就取出,没有则创建一个该数据的对象,然后自己调用save()方法保存


        dump($account);
    }

    /**
     * ORM修改操作
     */
    public function ormUpdate(){
        /*
        //通过模型修改数据
        $account = Account::find(11);
        $account->username = "ormUpdate2";
        $result = $account->save(); //返回布尔值结果

        dump($result);
        */

        $result = Account::where("id",">=","12")->update(
            ["sex"=>1]
        );
        //修改数据,返回受影响行数
        dump($result);
    }

    /**
     * ORM删除操作
     */
    public function ormDelete(){
        /*
        //通过模型删除数据
        $account = Account::find(13);
        $result = $account->delete();   //返回结果为布尔值,如果数据已删除,会报错
        dump($result);
        */

        //通过主键删除
        //$result = Account::destroy(14); //返回受影响行数

       // $result = Account::destroy([14,15,16]); //返回受影响行数
        $result = Account::where("id",">",18)->delete();

        dump($result);
    }

    /**
     * 视图实例
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view1(){

        $accounts = Account::get();

        return view("account.test1",[
            "username"=>"hou",
            "password"=>"123456",
            "sex"=>1,
            "arr"=>["name","hou","haha"],
            "accounts"=>$accounts,
            "accounts1"=>[]
        ]);
    }

    public function urlTest(){
        return "I am URL Test";
    }

    /**
     * Request的使用
     */
    public function request1(Request $request){
        //1.取值
        //echo $request->input("username","未知");    //获取单个值
        //echo $request->input("sex","未知");
        echo "<h3>取值:</h3>";
        if ($request->has("password")){
            echo $request->input("password");
        }else{
            echo "密码不存在";
        }

        $arr = $request->all();     //获取Request中的所有值
        dump($arr);


        //2.判断请求类型
        echo "<h3>判定请求类型: </h3>";
        echo $request->method();
        echo "<br />";
        if($request->isMethod("GET")){  //判断是某种请求
            echo "是GET请求.";
        }else{
            echo "不是GET请求.";
        }

        $bool = $request->is("account/*");  //判断是否属于某个路径底下
        dump($bool);

        echo "<br />";
        echo "当前的URL: " . $request->url();    //获取当前的URL
    }


    /**
     * Session的使用1
     */
    public function session1(Request $request){
        //1.通过Request的Session添加数据
        //$request->session()->put("key1","value1");

        //2.通过session()添加数据
        //session()->put("key2","value2");

        //3.通过Session对象添加数据
        //Session::put("key3","value3");
        //Session::put(["key4"=>"value4"]);   //以数组的形式存储数据

        //存储数据到数组
        Session::push("username","hou");
        Session::push("username","zhang");

        Session::flash("flash-key","flash-value");  //只有第一次访问的时候存在

    }

    /**
     * Session的使用2
     */
    public function session2(Request $request){

        /*
        //1.通过Request的Session获取数据
        echo "request请求: <br />";
        dump($request->session()->get("key1"));  //value1
        dump($request->session()->get("key99","default"));    //如果有键名则取出,没有则返回默认值
        */

        /*
        //2.通过session()获取数据
        echo "session(): <br />";
        dump(session()->get("key2"));
        */


        //3.通过Session对象取出数据
        echo "Session: <br /> ";
        dump(Session::get("key3"));
        dump(Session::get("key4"));
        //dump(Session::get("username"));

        //dump(Session::pull("username"));       //取出数据以后就把Session中的数据删除

        if(Session::has("username")){   //判断session中某个键值对是否存在
            echo "username存在";
        }else{
            echo "username不存在";
        }

        //Session::forget("key1");        //删除某个数据

        //Session::flush();       //清除session中所有数据

        dump(Session::get("flash-key"));

        dump(Session::all());       //取出session中所有数据
    }

    public function response(){
        //1.返回JSON数据
        /*
        $data = [
            "Code"=>1,
            "Message"=>"success",
            "data"=>"hou"
        ];

        return response()->json($data);
        */

        //2.重定向
        //return redirect("account/responsePage");    //使用路由地址重定向页面

        //return redirect("account/responsePage")
        //    ->with("message",["useranme"=>"hou","password"=>"123456"]);
        //使用路由地址重定向页面,并携带参数

        //return redirect()->action("AccountController@responsePage")
        //    ->with("message","I am message.");
        //通过控制器重定向页面,并携带参数

        //return redirect()->route("responsePage")
        //    ->with("message","I am message.");
        //通过路有别名重定向页面,并携带参数

        //return redirect()->back();  //返回至上一个页面
    }

    public function responsePage(){
        return Session::get("message","未获取到数据.");
    }


    //中间件演示
    public function activity0(){
        return "活动还未开始";
    }

    public function activity1(){
        return "活动正在进行1";
    }

    public function activity2(){
        return "活动正在进行2";
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $account = $request->input("Account");
            $data["code"] = 0;
            if(Account::create($account)){
                $data["code"] = 1;
                $data["message"] = "添加成功";
            }else{
                $data["message"] = "添加失败";
            }
            return $data;
        }
        $account = new Account();
        return view("account.create",[
            "account"=>$account
        ]);
    }

    public function del(Request $request){
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            if (Account::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
            }
        }
        return $data;
    }

    public function detail($id){
        $account = Account::find($id);
        return view("account.detail",[
            "account"=>$account
        ]);
    }

    public function modify(Request $request,$id){
        if($request->isMethod("POST")){
            $data["code"] = 0;
            $account = $request->input("Account");
            if(Account::where("id",$id)->update($account)){
                $data["code"] = 1;
                $data["message"] = "修改成功";
            }else{
                $data["message"] = "修改失败";
            }
            return $data;
        }

        $account = Account::find($id);
        return view("account.update",[
            "account"=>$account
        ]);
    }

    public function permission(){
        $user = User::find(1);
//        $user->givePermissionTo("search articles");   //给用户赋予一个权限
//        $user->assignRole("writer");  //给用户指派一个角色

        $role = Role::findByName("writer"); //获取名为writer的角色
//        $role->givePermissionTo("show articles"); //给角色赋予一个权限

        var_dump($user->hasRole('writer'));                     //判断用户是否具有某个角色
        $user->hasAnyRole(Role::all());         //用户具有任何一个角色就判定成功
        $user->hasAllRoles(Role::all());        //用户具有所有的角色才算成功
        $user->hasPermissionTo('edit articles');    //用户具有某一个权限
        $user->hasAnyPermission(['edit articles', 'publish articles', 'unpublish articles']);   //用户具有任意一个权限
        var_dump($user->can("search articles"));                //用户是否具有某个权限
        var_dump($role->hasPermissionTo("edit articles"));      //判断角色是否具有某个权限
        $user->hasDirectPermission('delete articles');  //判断用户是否直接具有某个权限



        //$user->removeRole('writer');                    //将用户的角色去除
        //$user->revokePermissionTo('edit articles');     //将用户的权限去除

        //$role->revokePermissionTo('edit articles');     //将角色的权限去除

//        $user->syncPermissions(['edit articles', 'delete articles']);       //同步权限,将旧的权限去除替换为新的权限
//        $user->syncRoles(['writer', 'admin']);          //同步角色,将用户旧的角色去除替换为新的权限



        //创建角色与权限
//        $role = Role::create(['name' => 'writer']);
//        $permission = Permission::create(['name' => 'delete articles']);

        //创建权限
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'search articles']);
//        Permission::create(['name' => 'show articles']);
//        Permission::create(['name' => 'update articles']);

        //获取用户的角色与权限
        $permissions = $user->permissions;      //获取用户直接继承来的权限
        $RolePer = $user->getPermissionsViaRoles(); //获取用户从角色继承过来的权限
        $perAndRole = $user->getAllPermissions();   //获取属于这个用户的所有权限,包括从角色继承过来的
        $roles = $user->getRoleNames();         //获取用户的角色名

//        dump($role);
//        dump($permission);
        dump($user);
        dump($permissions);
        dump($RolePer);
        dump($perAndRole);
        dump($roles);
    }

}