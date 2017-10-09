<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/16
 * Time: 12:14
 */

namespace App\Http\Controllers;


use App\PatientInfo;
use Illuminate\Http\Request;

class PatientInfoController extends Controller
{   //病人信息控制器

    public function index(){
        return view("index");
    }

    public function record(Request $request){
        $sortCols = ["name","id_card","hospital_number","phone1","admission_time"];

        $where = "1=1 ";
        $whereArray = [];

        $pageStart = $request->input("iDisplayStart",0);        //开始页码,默认为0
        $pageSize = $request->input("iDisplayLength",5);        //单页显示条数,默认为5

        //表格全局搜索条件
        if($request->has("sSearch") && $request->input("sSearch")!=""){
            $sSearch = $request->input("sSearch");
            $where .= "and (name like ? or id_card like ? or hospital_number like ? or phone1 like ?) ";
            //SQL语句 对指定字段进行模糊查询
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
            $whereArray[] = "%".$sSearch."%"; //添加对应查询条件的值
        }

        $patient_infos = PatientInfo::whereRaw($where,$whereArray)
            ->orderBy($sortCols[$request->input("iSortCol_0",0)],$request->input("sSortDir_0","asc"))
            ->offset($pageStart)
            ->limit($pageSize)
            ->get();

        $count = PatientInfo::whereRaw($where,$whereArray)
            ->count();  //获取一共查询到多少条记录

        //$sortCol = $request->input("sSortDir_0");

        $data["sEcho"] = $request->input("sEcho","");
        $data["iTotalDisplayRecords"] = $count;
        $data["iTotalRecords"] = count($patient_infos);
        $data["aaData"] = $patient_infos;
        return $data;

    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $patient_info = $request->input("PatientInfo");
            $patient_info["admission_time"] = isset($patient_info["admission_time"])?strtotime($patient_info["admission_time"]):null;       //入组时间
            $patient_info["birth_date"] = isset($patient_info["birth_date"])?strtotime($patient_info["birth_date"]):null;     //出生日期

            $data["code"] = 0;
            if(PatientInfo::create($patient_info)){
                $data["code"] = 1;
                $data["message"] = "添加成功";
            }else{
                $data["message"] = "添加失败";
            }
            return $data;
        }

        $patient_info = new PatientInfo();
        return view("patient_info.create",[
            "patient_info"=>$patient_info
        ]);
    }

    public function delete(Request $request){
        $data["message"] = "删除失败";
        $data["code"] = "0";
        if($request->has("ids") && $request->input("ids") != ""){
            if (PatientInfo::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
            }
        }

        return $data;
    }

    public function detail($id){
        $patient_info = PatientInfo::find($id);
        return view("patient_info.detail",[
            "patient_info"=>$patient_info
        ]);
    }

    public function update(Request $request,$id){
        if($request->isMethod("POST")){
            $data["code"] = 0;
            $data["message"] = "修改失败";
            $patient_info = $request->input("PatientInfo");
            $patient_info["admission_time"] = isset($patient_info["admission_time"])?strtotime($patient_info["admission_time"]):null;       //入组时间
            $patient_info["birth_date"] = isset($patient_info["birth_date"])?strtotime($patient_info["birth_date"]):null;     //出生日期

            if(PatientInfo::where("id",$id)->update($patient_info)){
                $data["code"] = 1;
                $data["message"] = "修改成功";
            }

            return $data;
        }

        $patient_info = PatientInfo::find($id);
        return view("patient_info.update",[
            "patient_info"=>$patient_info
        ]);
    }

}