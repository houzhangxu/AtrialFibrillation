<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 23:47
 */

namespace App;


class Relapse extends BaseModel
{   //房颤复发情况

    protected $table = "relapse";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","relapse_date","duration","stop_method", "write_manual",
        "blood_pressure_load", "mean_blood_pressure","average_heart_rate","heart_rate_lt_60","heart_rate_gte_61_lte_70",
        "heart_rate_gte_71_lte_80","heart_rate_gte_81_lte_90","heart_rate_gt_91"
    ];

    protected $STOP_METHOD = [  //怎么停止
        1=>"自行",
        2=>"药物",
        3=>"电复率"
    ];

    protected $WRITE_MANUAL = [ //是否填写手册
        1=>"是",
        2=>"否"
    ];


}