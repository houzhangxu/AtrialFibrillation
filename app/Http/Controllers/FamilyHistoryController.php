<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/16
 * Time: 12:09
 */

namespace App\Http\Controllers;


use App\FamilyHistory;
use App\PatientInfo;
use Illuminate\Http\Request;

class FamilyHistoryController extends Controller
{

    public function index(Request $request){
        $id = $request->input("uid",0);     //获取链接中的id,病人id
        $patient_info = PatientInfo::find($id);         //根据id查询病人基础信息
        $family = FamilyHistory::where("pid",$id)->first();  //根据id查询病人家庭史

        if($family == null){
            $family = new FamilyHistory();
            $family["pid"] = $id;
        }

        return view("family.index",[
            "patient_info"=>$patient_info,
            "family"=>$family
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $family = $request->input("Family");
            $pid = $family["pid"];
            $id_card = $family["id_card"];

            if(FamilyHistory::where("id_card",$id_card)->count()){
                if(FamilyHistory::where("id_card",$id_card)->update($family)){
                    return redirect("/family?uid=".$pid."&id_card=".$id_card)->with("result",["code"=>1,"message"=>"修改成功!"]);
                }else{
                    return redirect()->back()->with("result",["code"=>0,"message"=>"修改失败!"]);
                }
            }

            if(FamilyHistory::create($family)){
                return redirect("/family?uid=".$pid."&id_card=".$id_card)->with("result",["code"=>1,"message"=>"创建成功!"]);
            }else{
                return redirect()->back()->with("result",["code"=>0,"message"=>"创建失败!"]);
            }
        }
    }

    public function option($name,$key = -1){
        $option = (new FamilyHistory())->option($key,$name);
        $data = [];
        foreach ($option as $key => $value) {
            array_push($data,["id"=>$key,"text"=>$value]);
        }

        return $data;
    }

}