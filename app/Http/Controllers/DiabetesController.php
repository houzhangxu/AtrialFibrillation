<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 18:35
 */

namespace App\Http\Controllers;


use App\Diabetes;
use App\PatientInfo;
use Illuminate\Http\Request;
class DiabetesController extends Controller
{   //糖尿病控制器

    public function index(Request $request){
        $id_card = $request->input("id_card",0);     //获取链接中的id,病人id
        $patient_info = PatientInfo::where("id_card",$id_card)->first();         //根据id查询病人基础信息
        $form =  Diabetes::where("id_card",$id_card)->first();  //根据id查询病人冠心病

        if($form == null){
            $form = new Diabetes();
            $form["id_card"] = $id_card;
        }

        return view("Diabetes.index",[
            "patient_info"=>$patient_info,
            "form"=>$form
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $form = $request->input("Form");
            $id_card = $form["id_card"];

            if(Diabetes::where("id_card",$id_card)->count()){
                if(Diabetes::where("id_card",$id_card)->update($form)){
                    return redirect("/Diabetes?id_card=".$id_card)->with("result",["code"=>1,"message"=>"修改成功!"]);
                }else{
                    return redirect()->back()->with("result",["code"=>0,"message"=>"修改失败!"]);
                }
            }

            if(Diabetes::create($form)){
                return redirect("/Diabetes?id_card=".$id_card)->with("result",["code"=>1,"message"=>"创建成功!"]);
            }else{
                return redirect()->back()->with("result",["code"=>0,"message"=>"创建失败!"]);
            }
        }
    }

    public function option($name,$key = -1){
        $option = (new Diabetes())->option($key,$name);
        $data = [];
        foreach ($option as $key => $value) {
            array_push($data,["id"=>$key,"text"=>$value]);
        }

        return $data;
    }

}