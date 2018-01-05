<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/12/12
 * Time: 13:38
 */

namespace App\Http\Controllers\Admin;


use App\CAE;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CAEController extends Controller
{
    public function index(){
        return view("admin.cae.index");
    }

    public function record(Request $request){
        $sortCols = ["id","chinese_name","english_name","created_at","updated_at"];

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

        $roles = CAE::whereRaw($where,$whereArray)
            ->orderBy($sortCols[$sortCol],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();

        $count = CAE::whereRaw($where,$whereArray)
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
            $data["message"] = "字段创建失败";
            if (CAE::where("name",$permission["name"])->first()){
                $data["code"] = 0;
                $data["message"] = "字段创建失败,已存在该字段";
                return $data;
            }

            if(CAE::create(["name"=>$permission["name"]])){
                $data["code"] = 1;
                $data["message"] = "字段创建成功";
            }

            return $data;
        }

        return view("admin.permissions.create");
    }

    public function update(Request $request,$id){
        if($request->isMethod("POST")){
            $permission = $request->input("Permissions");

            $data["code"] = 0;
            $data["message"] = "字段修改失败";
            if (CAE::where("name",$permission["name"])->first()){
                $data["code"] = 0;
                $data["message"] = "字段修改失败,已存在该字段";
                return $data;
            }

            $p = CAE::find($id);
            if($p->update(["name"=>$permission["name"]])){
                $data["code"] = 1;
                $data["message"] = "字段修改成功";
            }

            return $data;
        }

        $permission = CAE::find($id);

        return view("admin.permissions.update",[
            "permission"=>$permission,
            "id"=>$id
        ]);
    }

    public function detail($id){
        $permission = CAE::find($id);
        return view("admin.permissions.detail",[
            "permission"=>$permission,
            "id"=>$id
        ]);
    }

    public function getAllPermissions(){    //返回前台json数据
        $permissions = CAE::get()->pluck("name");
        $data = [];
        foreach ($permissions as $key => $value) {
            array_push($data,["id"=>$value,"text"=>$value]);
        }
        return $data;
    }

    public function delete(Request $request){   //字段删除
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            $ids = $request->input("ids");
            $permission = CAE::find($ids);

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
            'chinese_name' => 'required|string|max:255|unique:cae',
            'english_name' => 'required|string|max:255|unique:cae',
        ]);
    }

}