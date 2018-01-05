<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 14:27
 */

namespace App\Http\Controllers;


use App\ArrhythmicDrugsMeasure;
use App\PatientInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArrhythmicDrugsController extends Controller
{   //心律失常药物控制器

    public function measure(Request $request){
        $id_card = $request->input("id_card",0);     //获取链接中的身份证,病人id_card
        $patient_info = PatientInfo::where("id_card",$id_card)->first();         //根据id_card查询病人基础信息
        $measures = ArrhythmicDrugsMeasure::where("id_card",$id_card)->get();

        return view("ArrhythmicDrugs.measure",[
            "patient_info"=>$patient_info,
            "measures"=>$measures
        ]);
    }

    public function measureCreate(Request $request){

        if($request->isMethod("Post")){
            $data["code"] = 1;
            $data["message"] = "添加失败";

            $measure = $request->input("Measure");
            $measure["measure_time"] = strtotime($measure["measure_time"]);

            if(ArrhythmicDrugsMeasure::create($measure)){
                $data["code"] = 1;
                $data["message"] = "添加成功";
            }
            Session::flash("result",$data);

            return $data;
        }

        $id_card = $request->input("id_card",0);     //获取链接中的身份证,病人id_card
        $patient_info = PatientInfo::where("id_card",$id_card)->first();         //根据id_card查询病人基础信息
        $measure = new ArrhythmicDrugsMeasure();

        return view("ArrhythmicDrugs.measure_create",[
            "patient_info"=>$patient_info,
            "measure"=>$measure
        ]);
    }

    public function measureUpdate(Request $request,$id){

        if($request->isMethod("Post")){
            $data["code"] = 1;
            $data["message"] = "修改失败";

            $measure = $request->input("Measure");
            $measure["measure_time"] = strtotime($measure["measure_time"]);

            if(ArrhythmicDrugsMeasure::where("id",$id)->update($measure)){
                $data["code"] = 1;
                $data["message"] = "修改成功";
                Session::flash("result",$data);
            }

            return $data;
        }

        $measure = ArrhythmicDrugsMeasure::find($id);
        if($measure == null){
            return "未找到记录";
        }

        $id_card = $measure->id_card;
        $patient_info = PatientInfo::where("id_card",$id_card)->first();

        return view("ArrhythmicDrugs.measure_update",[
            "patient_info"=>$patient_info,
            "measure"=>$measure
        ]);
    }

    public function measureDelete(Request $request){
        $data["message"] = "删除失败";
        $data["code"] = "0";

        if($request->has("ids") && $request->input("ids") != ""){
            if (ArrhythmicDrugsMeasure::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
                Session::flash("result",$data);
            }
        }

        return $data;
    }


}