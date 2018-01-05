<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 15:05
 */

namespace App;


class AtrialFibrillationBurdenMeasure extends BaseModel
{   //房颤负荷

    protected $table = "atrial_fibrillation_burden_measure";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","load_hour","heart_rate_day","atrial_premature_beats","premature_ventricualr_contraction","measure_time"];

}