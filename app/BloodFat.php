<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 18:00
 */

namespace App;


class BloodFat extends BaseModel
{   //血脂

    protected $table = "blood_fat";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","triglyceride","cholesterol_total","high_density_lipoprotein",
        "low_densith_lipoprotein", "very_low_density_lipoprotein","statin","dose","measure_time"];

    protected $STATIN = [   //他汀
        0=>"无",
        1=>"立普妥",
        2=>"舒降之",
        3=>"可定",
        4=>"依折麦布",
    ];

}