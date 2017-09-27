<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/27
 * Time: 16:12
 */

namespace App;


class AnticoagulantRegimen extends BaseModel
{   //抗凝方案

    protected $table = "anticoagulant_regimen";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","anti_freezing",
        "xarelto_dose","CHADS2","CHA2DS2_VASC", "HASBLED"];

    protected $ANTI_FREEZING = [    //抗凝方案
        1=>"华法令",
        2=>"拜瑞妥",
        3=>"阿司匹林",
        4=>"无"
    ];



}