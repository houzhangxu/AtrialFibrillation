<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 18:31
 */

namespace App;


class Diabetes extends BaseModel
{   //糖尿病

    protected $table = "diabetes";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","diabetes","medical_history","fasting_plasma_glucose","HbA1","HbA1C","metformin",
        "glimepiride","acarbose", "coronary_artery_stenosis", "statin","aspirin","polivy"];

    protected $DIABETES = [    //糖尿病
        1=>"是",
        2=>"否"
    ];

    protected $ACARBOSE = [ //阿卡波糖
        0=>"无",
        1=>"卡博平片"
    ];


}