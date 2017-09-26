<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/14
 * Time: 0:08
 */

namespace App\Http\Controllers;

use App\PatientInfo;
class AdminController extends Controller
{
    //主页
    public function index(){

        return view("index");
    }

    public function option($clazz,$name,$key = null){  //通用获取选项方法   废除
        /*
        if($ind != -1){
            return array_key_exists($ind,$this->$filed) ? $this->$filed[$ind] : $this->UN;
        }

        return $this->$filed;
        */
        $c = new $clazz();
        dump($c);

        echo $clazz;

        echo "<br />".$name;
        echo "<br />" . $key;
    }

}