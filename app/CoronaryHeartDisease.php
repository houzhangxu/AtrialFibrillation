<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/27
 * Time: 15:51
 */

namespace App;


class CoronaryHeartDisease extends BaseModel
{   //冠心病

    protected $table = "coronary_heart_disease";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","coronary_heart_disease","stent_implantation",
        "coronary_artery_stenosis", "statin","aspirin","polivy"];

    protected $CORONARY_HEART_DISEASE = [    //冠心病史
        1=>"是",
        2=>"否"
    ];

    protected $STENT_IMPLANTATION = [    //是否支架植入
        1=>"是",
        2=>"否"
    ];

    protected $STATIN = [    //他汀
        1=>"阿托伐他汀",
        2=>"辛伐他汀",
        3=>"瑞苏伐他汀",
        4=>"依折麦布",
        5=>"无"
    ];

    protected $ASPIRIN = [    //阿司匹林
        1=>"是",
        2=>"否"
    ];

    protected $POLIVY = [    //波利维
        1=>"是",
        2=>"否"
    ];



}