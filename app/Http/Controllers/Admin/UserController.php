<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/11/23
 * Time: 0:45
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{   //用户控制器

    public function index(){
        return view("admin.user.index");
    }

    public function record(Request $request){
        $sortCols = ["id","name","email","created_at"];

        $where = "1=1 ";
        $whereArray = [];

        $pageStart = $request->input("iDisplayStart",0);        //开始页码,默认为0
        $pageSize = $request->input("iDisplayLength",5);        //单页显示条数,默认为5
        $sortCol = 0;
        if($request->input("iSortCol_0") < count($sortCols)){
            $sortCol = $request->input("iSortCol_0",0);
        }

        //表格全局搜索条件
        if($request->has("sSearch") && $request->input("sSearch")!=""){
            $sSearch = $request->input("sSearch");
            $where .= "and (name like ? or email like ? ) ";
            //SQL语句 对指定字段进行模糊查询
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
        }

        $users = User::whereRaw($where,$whereArray)
            ->with(["roles"=>function($query){
                $query->select("name");
            },"permissions"=>function($query){
                $query->select("name");
            }])
            ->orderBy($sortCols[$sortCol],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();
        $users->load("roles.permissions");

        $count = User::whereRaw($where,$whereArray)
            ->count();  //获取一共查询到多少条记录

        //$sortCol = $request->input("sSortDir_0");

        $data["sEcho"] = $request->input("sEcho","");
        $data["iTotalDisplayRecords"] = $count;
        $data["iTotalRecords"] = count($users);
        $data["aaData"] = $users;
        return $data;
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $user = $request->input("User");
            $roleArrays = array_filter(explode(",",$request->input("role")));
            $permissionArrays = array_filter(explode(",",$request->input("permissions")));

            $user["password"] = bcrypt($user["password"]);
            $this->validator($user)->validate();

            $data["code"] = 0;
            $data["message"] = "添加失败";

            $r = User::create($user);
            if($r){
                $r->assignRole($roleArrays);                 //指派角色
                $r->givePermissionTo($permissionArrays);     //赋予权限
                $data["code"] = 1;
                $data["message"] = "添加成功";
            }
            return $data;
        }
        return view("admin.user.create");
    }

    public function update(Request $request,$id){
        if($request->isMethod("POST")){
            $user = $request->input("User");


            $u= User::find($id);
            if($u["email"] != $user["email"]){
                Validator::make($user, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                ])->validate();
                $r["email"] = $user["email"];
            }else{
                Validator::make($user, [
                    'name' => 'required|string|max:255'
                ])->validate();
            }

            $data["code"] = 0;
            $data["message"] = "修改失败";
            if($u->update($user)){

                $roleArrays = array_filter(explode(",",$request->input("role")));
                $permissionArrays = array_filter(explode(",",$request->input("permissions")));

                $u->syncRoles($roleArrays);     //同步用户角色
                $u->syncPermissions($permissionArrays);     //同步用户权限

                $data["code"] = 1;
                $data["message"] = "修改成功";
            }
            return $data;
        }

        $user = User::find($id);

        $roles = $user->roles->pluck("name");
        $permissions = $user->permissions->pluck("name");

        $roleStr = implode(",",$roles->toArray());
        $permissionStr = implode(",",$permissions->toArray());


        return view("admin.user.update",[
            "user"=>$user,
            "id"=>$id,
            "roles"=>$roleStr,
            "permissions"=>$permissionStr
        ]);
    }

    public function detail($id){
        $user = User::find($id);
        return view("admin.user.detail",[
            "user"=>$user,
            "id"=>$id
        ]);
    }

    public function reset(Request $request,$id){
        if($request->isMethod("POST")){
            $user = $request->input("User");
            $user["password"] = bcrypt($user["password"]);

            Validator::make($user,[
                'password' => 'required|string|min:6'
            ])->validate();

            $data["code"] = 0;
            $data["message"] = "重置失败";
            if(User::where("id",$id)->update($user)){
                $data["code"] = 1;
                $data["message"] = "重置成功";
            }
            return $data;
        }

        return view("admin.user.reset",[
            "id"=>$id
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

}