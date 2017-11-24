<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/11/23
 * Time: 4:02
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{   //角色控制器

    public function index(){
        $roles = Role::find(1);

//        return $roles;
        return view("admin.role.index");
    }

    public function record(Request $request){
        $sortCols = ["id","name","created_at","updated_at"];

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
            $where .= "and (name like ?) ";
            //SQL语句 对指定字段进行模糊查询
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
        }

        $roles = Role::whereRaw($where,$whereArray)
            ->with(["permissions"=>function($query){
                $query->select("name");
            }])
            ->orderBy($sortCols[$sortCol],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();

        $count = Role::whereRaw($where,$whereArray)
            ->count();  //获取一共查询到多少条记录

        //$sortCol = $request->input("sSortDir_0");

        $data["sEcho"] = $request->input("sEcho","");
        $data["iTotalDisplayRecords"] = $count;
        $data["iTotalRecords"] = count($roles);
        $data["aaData"] = $roles;
        return $data;
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $role = $request->input("Role");
            $permissionArrays = array_filter(explode(",",$request->input("permissions")));

            $data["code"] = 0;
            $data["message"] = "角色创建失败";

            $this->validator($role)->validate();

            /*  废弃的判断创建角色是否存在
            if (Role::where("name",$role["name"])->first()){
                $data["code"] = 0;
                $data["message"] = "角色创建失败,已存在该角色";
                return $data;
            }
            */

            $r = Role::create(["name"=>$role["name"]]);
            if($r != null){
                $data["code"] = 1;
                $data["message"] = "角色创建成功";
                $r->givePermissionTo($permissionArrays);
            }

            return $data;
        }

        return view("admin.role.create");
    }

    public function update(Request $request,$id){
        if($request->isMethod("POST")){
            $role = $request->input("Role");
            $permissionArrays = array_filter(explode(",",$request->input("permissions")));

            $data["code"] = 0;
            $data["message"] = "角色修改失败";

            //$this->validator($role)->validate();
            /*
            if (Role::where("name",$role["name"])->first()){
                $data["code"] = 0;
                $data["message"] = "角色修改失败,已存在该角色";
                return $data;
            }
            */

            $r = Role::findOrFail($id);

            if($r["name"] != $role["name"]){
                $this->validator($role)->validate();
                $r->update($role);  //更新角色
            }

            $r->syncPermissions($permissionArrays);     //同步角色权限

            $data["code"] = 1;
            $data["message"] = "角色修改成功";

            return $data;
        }

        $role = Role::find($id);
        $permissions = $role->permissions->pluck("name");

        $str = implode(",",$permissions->toArray());
        return view("admin.role.update",[
            "role"=>$role,
            "permissions"=>$str,
            "id"=>$id
        ]);
    }

    public function detail($id){
        $role = Role::with("permissions")->find($id);
        return view("admin.role.detail",[
            "role"=>$role,
            "id"=>$id
        ]);
    }

    public function delete1(Request $request){  //废弃的删除方法
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            $ids = $request->input("ids");
            $role = Role::find($ids);   //根据ID提取角色
            $users = User::role($role["name"])->get();  //获取所有拥有该角色的用户
            foreach ($users as $user){  //遍历用户
                $user->removeRole($role["name"]);   //删除用户的角色
            }
            if (Role::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
            }
        }

        return $data;
    }

    public function delete(Request $request){   //角色删除
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            $ids = $request->input("ids");
            $role = Role::find($ids);
            if($role->delete($ids)){
                $data["message"] = "删除成功";
                $data["code"] = "1";
            }
        }

        return $data;
    }

    public function getAllRoles(){
        //$role = Role::find(1);
        //dump( $role->permissions[0]["name"]);
        //return Role::get()->pluck("name");
        $roles = Role::get()->pluck("name");
        $data = [];
        foreach ($roles as $key => $value) {
            array_push($data,["id"=>$value,"text"=>$value]);
        }
        return $data;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:roles'
        ]);
    }


}