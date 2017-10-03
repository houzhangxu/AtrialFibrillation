<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/1
 * Time: 21:39
 */

namespace App;


class ArrhythmicDrugsMeasure extends BaseModel
{   //心律失常药物

    protected $table = "arrhythmic_drugs_measure";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","amiodaronum","propafenone","zok","dose","measure_time"];

    protected $ZOK = [    //美托洛尔缓释片
        0=>"无",
        1=>"美托洛尔",
        2=>"比索洛尔"
    ];


}