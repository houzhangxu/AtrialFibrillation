<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/12/21
 * Time: 15:51
 */

namespace App;


class ModelManger extends BaseModel
{

    protected $table = "model";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["name","route","pid"];

    public function getTree(){
        $model = $this->get();
        return $this->tree($model,0);
    }

    public function tree($model,$pid = 0){
        $arr = [];
        foreach ($model as $key => $item){
            if($item["pid"] == $pid){
                $a["id"] = $item["id"];
                $a["name"] = $item["name"];
                $a["route"] = $item["route"];
                $a["item"] = $this->tree($model,$item["id"]);
                $arr[] = $a;
            }
        }

        return $arr;
    }

}