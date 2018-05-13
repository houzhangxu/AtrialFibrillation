<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/26
 * Time: 23:04
 */

namespace App\Http\Controllers;


use App\Hypertension;
use App\HypertensionMeasure;
use App\PatientInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HypertensionController extends Controller
{   //高血压控制器

    public function index(Request $request){
        $id_card = $request->input("id_card",0);     //获取链接中的id,病人id_card
        $patient_info = PatientInfo::where("id_card",$id_card)->first();         //根据id_card查询病人基础信息
        $form = Hypertension::where("id_card",$id_card)->first();  //根据id查询病人家庭史

        if($form == null){
            $form = new Hypertension();
            $form["id_card"] = $id_card;
        }

        return view("hypertension.index",[
            "patient_info"=>$patient_info,
            "form"=>$form
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $form = $request->input("Form");
            $id_card = $form["id_card"];

            if(Hypertension::where("id_card",$id_card)->count()){
                if(Hypertension::where("id_card",$id_card)->update($form)){
                    return redirect("/hypertension?id_card=".$id_card)->with("result",["code"=>1,"message"=>"修改成功!"]);
                }else{
                    return redirect()->back()->with("result",["code"=>0,"message"=>"修改失败!"]);
                }
            }

            if(Hypertension::create($form)){
                return redirect("/hypertension?id_card=".$id_card)->with("result",["code"=>1,"message"=>"创建成功!"]);
            }else{
                return redirect()->back()->with("result",["code"=>0,"message"=>"创建失败!"]);
            }
        }
    }

    public function option($name,$key = -1){
        $option = (new Hypertension())->option($key,$name);
        $data = [];
        foreach ($option as $key => $value) {
            array_push($data,["id"=>$key,"text"=>$value]);
        }

        return $data;
    }

    public function measure(Request $request){
        $id_card = $request->input("id_card",0);     //获取链接中的身份证,病人id
        $patient_info = PatientInfo::where("id_card",$id_card)->first();         //根据id查询病人基础信息
        $measures = HypertensionMeasure::where("id_card",$id_card)->get();

        return view("hypertension.measure",[
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

            if(HypertensionMeasure::create($measure)){
                $data["code"] = 1;
                $data["message"] = "添加成功";
            }
            Session::flash("result",$data);

            return $data;
        }

        $id_card = $request->input("id_card",0);     //获取链接中的身份证,病人id_card
        $patient_info = PatientInfo::where("id_card",$id_card)->first();         //根据id_card查询病人基础信息
        $measures = HypertensionMeasure::where("id_card",$id_card)->get();

        return view("hypertension.measure_create",[
            "patient_info"=>$patient_info
        ]);
    }

    public function measureUpdate(Request $request,$id){

        if($request->isMethod("Post")){
            $data["code"] = 1;
            $data["message"] = "修改失败";

            $measure = $request->input("Measure");
            $measure["measure_time"] = strtotime($measure["measure_time"]);

            if(HypertensionMeasure::where("id",$id)->update($measure)){
                $data["code"] = 1;
                $data["message"] = "修改成功";

            }
            Session::flash("result",$data);

            return $data;
        }

        $measure = HypertensionMeasure::find($id);
        if($measure == null){
            return "未找到记录";
        }

        $id_card = $measure->id_card;
        $patient_info = PatientInfo::where("id_card",$id_card)->first();

        return view("hypertension.measure_update",[
            "patient_info"=>$patient_info,
            "measure"=>$measure
        ]);
    }

    public function measureDelete(Request $request){
        $data["message"] = "删除失败";
        $data["code"] = "0";

        if($request->has("ids") && $request->input("ids") != ""){
            if (HypertensionMeasure::destroy($request->input("ids"))){
                $data["message"] = "删除成功";
                $data["code"] = "1";
                Session::flash("result",$data);
            }
        }

        return $data;
    }


}