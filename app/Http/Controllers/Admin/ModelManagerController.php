<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/12/21
 * Time: 15:54
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\ModelManger;
use Illuminate\Http\Request;

class ModelManagerController extends Controller
{   //模块管理

    public function index(){

        return view("admin.model.index",[
        ]);
    }

    public function record(Request $request,$pid = 0){
        $sortCols = ["id","name","route","created_at","updated_at"];

        $where = "pid = ".$pid;
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
            $where .= " and (name like ?) ";
            $where .= "or (route like ?) ";
            //SQL语句 对指定字段进行模糊查询
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
        }

        $record = ModelManger::whereRaw($where,$whereArray)
            ->orderBy($sortCols[$sortCol],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();

        $count = ModelManger::whereRaw($where,$whereArray)
            ->count();  //获取一共查询到多少条记录

        //$sortCol = $request->input("sSortDir_0");

        $data["sEcho"] = $request->input("sEcho","");
        $data["iTotalDisplayRecords"] = $count;
        $data["iTotalRecords"] = count($record);
        $data["aaData"] = $record;

        return $data;
    }

    public function create(Request $request,$pid = 0){
        if($request->isMethod("POST")){
            $model = $request->input("Model");
            $model["pid"] = $pid;

            $data["code"] = 0;
            $data["message"] = "模块创建失败";

            if(ModelManger::create($model)){
                $data["code"] = 1;
                $data["message"] = "模块创建成功";
            }

            return $data;
        }

        return view("admin.model.create",[
            "pid"=>$pid
        ]);
    }

    public function update(Request $request,$id){
        if($request->isMethod("POST")){
            $model = $request->input("Model");

            $data["code"] = 0;
            $data["message"] = "模块更新失败";

            if(ModelManger::where("id",$id)->update($model)){
                $data["code"] = 1;
                $data["message"] = "模块更新成功";
            }

            return $data;
        }

        $model = ModelManger::find($id);

        return view("admin.model.update",[
            "model"=>$model,
            "id"=>$id
        ]);
    }

    public function delete(Request $request){
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            if (ModelManger::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
            }
        }

        return $data;
    }

    public function detail($id){
        $model = ModelManger::find($id);
        return view("admin.model.detail",[
            "model"=>$model
        ]);
    }

    public function re(){
        $data = [
            [
                "id"=>0,
                "text"=>"hh",
                "children"=>[
                    [
                    "id"=>1,
                    "text"=>"zz",
                    "leaf"=>true
                    ]
                ]
            ]
        ];

        return $data;
    }

    public function getChildren($pid = 0){     //找孩子
        $data = [];     //创建婴儿车

        $model = ModelManger::where(["pid"=>$pid])->get();      //根据父亲的id来寻找孩子

        foreach ($model as $item){          //把孩子们进行遍历
            $child["id"] = $item->id;       //获得孩子的id
            $child["text"] = $item->name;   //获得孩子的名称
            $child["href"] = url("admin/model/tree/".$item->id);    //给孩子添加他孩子的地址

            /*
            if(!ModelManger::where(["pid"=>$item->id])->count()){
                $child["leaf"] = true;
                $child["href"] = "#";
            }
            */

            $data[] = $child;               //将孩子添加到婴儿车
        }


        return $data;   //把婴儿车返回
    }

    public function testTree(){
        $model = new ModelManger();
        $tree = $model->getTree();

        return $tree;
    }

}