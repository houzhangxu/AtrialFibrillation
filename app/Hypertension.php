<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/26
 * Time: 23:03
 */

namespace App;

class Hypertension extends BaseModel
{   //高血压
    protected $table = "hypertension";   //指定表名
    protected $primaryKey = "id";   //指定主键

    public $timestamps = true;   //维护时间戳

    protected $fillable = ["id_card","pid","hypertension",
        "hypertension_year","maximum_systolic_blood_pressure",
        "peak_diastolic_pressure","CCB","B_BLOCKER",
        "type","type_dose","ACEI","ACEI_varieties","ARB","ARB_varieties","diuretic","other_hypotensor"]
    ;

    protected $HYPERTENSION = [    //高血压
        1=>"是",
        2=>"否"
    ];

    protected $_CCB = [    //CCB
        1=>"是",
        2=>"否"
    ];

    protected $_B_BLOCKER = [    //B-BLOCKER
        1=>"是",
        2=>"否"
    ];

    protected $TYPE = [    //类型
        1=>"美托洛尔",
        2=>"比索洛尔"
    ];

    protected $_ACEI = [    //B-BLOCKER
        1=>"是",
        2=>"否"
    ];

    protected $ACEI_VARIETIES = [    //ACEI类型
        1=>"培哚普利",
        2=>"依那普利"
    ];

    protected $_ARB = [    //ARB
        1=>"是",
        2=>"否"
    ];

    protected $ARB_VARIETIES = [    //ARB品种
        1=>"氯沙坦",
        2=>"厄贝沙坦",
        3=>"缬沙坦"
    ];

    protected $DIURETIC = [    //利尿剂
        1=>"是",
        2=>"否"
    ];


}