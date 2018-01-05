<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/16
 * Time: 12:07
 */

namespace App;


class FamilyHistory extends BaseModel
{   //家庭史
    protected $table = "family_history";   //指定表名
    protected $primaryKey = "id";   //指定主键

    public $timestamps = true;   //维护时间戳

    protected $fillable = ["id_card","father","mother","brother","sisters","son","daughter"];

    protected $DISEASE = [
        1=>"AF",
        2=>"冠心病",
        3=>"脑卒中",
        4=>"高血压",
        5=>"糖尿病",
    ];




}