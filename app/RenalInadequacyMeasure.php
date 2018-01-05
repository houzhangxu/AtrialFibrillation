<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 15:32
 */

namespace App;


class RenalInadequacyMeasure extends BaseModel
{   //肾功能不全

    protected $table = "renal_inadequacy_measure";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","serum_creatinine","egfr","CKD","CY_C","uric_acid","usea_nitrogen","homocysteine","urine_protein","bld","urinary_PH","specific_gravity_of_urine","measure_time"];

}