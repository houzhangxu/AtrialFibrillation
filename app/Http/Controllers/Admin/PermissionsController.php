<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/11/23
 * Time: 4:02
 */

namespace app\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{   //权限控制器

    public function index(){
        return view("admin.permissions.index");
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

        $roles = Permission::whereRaw($where,$whereArray)
            ->orderBy($sortCols[$sortCol],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();

        $count = Permission::whereRaw($where,$whereArray)
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
            $permission = $request->input("Permissions");

            $data["code"] = 0;
            $data["message"] = "权限创建失败";
            if (Permission::where("name",$permission["name"])->first()){
                $data["code"] = 0;
                $data["message"] = "权限创建失败,已存在该权限";
                return $data;
            }

            if(Permission::create(["name"=>$permission["name"]])){
                $data["code"] = 1;
                $data["message"] = "权限创建成功";
            }

            return $data;
        }

        return view("admin.permissions.create");
    }

    public function update(Request $request,$id){
        if($request->isMethod("POST")){
            $permission = $request->input("Permissions");

            $data["code"] = 0;
            $data["message"] = "权限修改失败";
            if (Permission::where("name",$permission["name"])->first()){
                $data["code"] = 0;
                $data["message"] = "权限修改失败,已存在该权限";
                return $data;
            }

            $p = Permission::find($id);
            if($p->update(["name"=>$permission["name"]])){
                $data["code"] = 1;
                $data["message"] = "权限修改成功";
            }

            return $data;
        }

        $permission = Permission::find($id);

        return view("admin.permissions.update",[
            "permission"=>$permission,
            "id"=>$id
        ]);
    }

    public function detail($id){
        $permission = Permission::find($id);
        return view("admin.permissions.detail",[
            "permission"=>$permission,
            "id"=>$id
        ]);
    }

    public function getAllPermissions(){    //返回前台json数据
        $permissions = Permission::get()->pluck("name");
        $data = [];
        foreach ($permissions as $key => $value) {
            array_push($data,["id"=>$value,"text"=>$value]);
        }
        return $data;
    }

    public function delete(Request $request){   //权限删除
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            $ids = $request->input("ids");
            $permission = Permission::find($ids);

            if($permission->delete($ids)){
                $data["message"] = "删除成功";
                $data["code"] = "1";
            }
        }

        return $data;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:permissions',
        ]);
    }

}