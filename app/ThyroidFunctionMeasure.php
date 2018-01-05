<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 17:39
 */

namespace App;


class ThyroidFunctionMeasure extends BaseModel
{   //甲状腺功能

    protected $table = "thyroid_function_measure";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","thyroxine","triiodothyronine","third_generation_thyroid_stimulating_hormone",
        "free_thyroxine", "free_triiodothyronine","thyroid_peroxidase_antibody","measure_time"];

}