<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 18:02
 */

namespace App\Http\Controllers;

use App\BloodFat;
use App\PatientInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class BloodFatController extends Controller
{   //血脂

    public function measure(Request $request){
        $id = $request->input("uid",0);     //获取链接中的id,病人id
        $id_card = $request->input("id_card",0);     //获取链接中的身份证,病人id
        $patient_info = PatientInfo::find($id);         //根据id查询病人基础信息
        $measures = BloodFat::where("id_card",$id_card)->get();

        return view("BloodFat.measure",[
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

            if(BloodFat::create($measure)){
                $data["code"] = 1;
                $data["message"] = "添加成功";
            }
            Session::flash("result",$data);

            return $data;
        }

        $id = $request->input("uid",0);     //获取链接中的id,病人id
        $id_card = $request->input("id_card",0);     //获取链接中的身份证,病人id
        $patient_info = PatientInfo::find($id);         //根据id查询病人基础信息
        $measure = new BloodFat();

        return view("BloodFat.measure_create",[
            "patient_info"=>$patient_info,
            "measure"=>$measure
        ]);
    }

    public function measureUpdate(Request $request,$id){

        if($request->isMethod("Post")){
            $data["code"] = 1;
            $data["message"] = "修改失败";

            $measur = $request->input("Measure");
            $measur["measure_time"] = strtotime($measur["measure_time"]);

            if(BloodFat::where("id",$id)->update($measur)){
                $data["code"] = 1;
                $data["message"] = "修改成功";
                Session::flash("result",$data);
            }

            return $data;
        }

        $measure = BloodFat::find($id);
        if($measure == null){
            return "未找到记录";
        }

        $id_card = $measure->id_card;
        $patient_info = PatientInfo::where("id_card",$id_card)->first();

        return view("BloodFat.measure_update",[
            "patient_info"=>$patient_info,
            "measure"=>$measure
        ]);
    }

    public function measureDelete(Request $request){
        $data["message"] = "删除失败";
        $data["code"] = "0";

        if($request->has("ids") && $request->input("ids") != ""){
            if (BloodFat::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
                Session::flash("result",$data);
            }
        }

        return $data;
    }

}