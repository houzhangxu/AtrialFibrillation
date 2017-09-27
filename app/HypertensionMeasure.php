<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/27
 * Time: 17:57
 */

namespace App;


class HypertensionMeasure extends BaseModel
{
    protected $table = "hypertension_measure";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","systolic_pressure","diastolic_pressure","measure_time"];



}