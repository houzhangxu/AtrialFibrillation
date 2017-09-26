<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/24
 * Time: 23:34
 */

namespace App\Http\Controllers;

use App\PatientInfo;

use App\SmokeDrink;
use Illuminate\Http\Request;

class SmokeDrinkController extends Controller
{

    public function index(Request $request){
        $id = $request->input("uid",0);     //获取链接中的id,病人id
        $patient_info = PatientInfo::find($id);         //根据id查询病人基础信息
        $form = SmokeDrink::where("pid",$id)->first();  //根据id查询病人家庭史

        if($form == null){
            $form = new SmokeDrink();
            $form["pid"] = $id;
        }

        return view("sd.index",[
            "patient_info"=>$patient_info,
            "form"=>$form
        ]);
    }

    public function create(Request $request){
        if($request->isMethod("POST")){
            $form = $request->input("Form");
            $pid = $form["pid"];
            $id_card = $form["id_card"];

            dump($form);
            dump($pid);
            
            die;
            if(SmokeDrink::where("id_card",$id_card)->count()){
                if(SmokeDrink::where("id_card",$id_card)->update($form)){
                    return redirect("/sd?uid=".$pid."&id_card=".$id_card)->with("result",["code"=>1,"message"=>"修改成功!"]);
                }else{
                    return redirect()->back()->with("result",["code"=>0,"message"=>"修改失败!"]);
                }
            }

            if(SmokeDrink::create($form)){
                return redirect("/sd?uid=".$pid."&id_card=".$id_card)->with("result",["code"=>1,"message"=>"创建成功!"]);
            }else{
                return redirect()->back()->with("result",["code"=>0,"message"=>"创建失败!"]);
            }
        }
    }

    public function option($name,$key = -1){
        $option = (new SmokeDrink())->option($key,$name);
        $data = [];
        foreach ($option as $key => $value) {
            array_push($data,["id"=>$key,"text"=>$value]);
        }

        return $data;
    }


}