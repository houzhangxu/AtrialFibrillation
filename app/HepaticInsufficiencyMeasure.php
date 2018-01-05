<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 17:06
 */

namespace App;


class HepaticInsufficiencyMeasure extends BaseModel
{   //肝功能不全

    protected $table = "hepatic_insufficiency_measure";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","total_protein","albumin","globulin","globulin_proportion","glutamic_pyruvic_transaminase","aspartate_transaminase",
        "total_bilirubin","bilirubin_direct","indirect_bilirubin","hepatinica","measure_time"];

    protected $HEPATINICA = [   //护肝药
        1=>"是",
        2=>"否"
    ];

}