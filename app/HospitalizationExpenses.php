<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 23:01
 */

namespace App;


class HospitalizationExpenses extends BaseModel
{   //住院费用

    protected $table = "hospitalization_expenses";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","cost","medical_insurance_amount","self_amount","western_medicine_fee","treatment_fee",
        "material_cost","nursing_fee","special_fee","laboratory_fee","laboratory_material","inspection_fee",
        "check_material_cost","bed_fee", "hospital_stay","medical_insurance","medical_insurance_where"];

    protected $MEDICAL_INSURANCE = [   //是否医保
        1=>"是",
        2=>"否"
    ];



}