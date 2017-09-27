<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/27
 * Time: 16:01
 */

namespace App;


class CerebralApoplexy extends BaseModel
{   //脑卒中

    protected $table = "cerebral_apoplexy";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","cerebral_apoplexy","medical_history","MRI_ischemic_focus","position",
        "num", "gyrus_width_increase","ventriculomegaly","carotid_atherosclerotic_plaque","patch_size","intracranial_vascular_stenosis"];

    protected $CEREBRAL_APOPLEXY = [    //脑卒中史
        1=>"是",
        2=>"否"
    ];

    protected $MRI_ISCHEMIC_FOCUS = [    //MRI缺血灶
        1=>"是",
        2=>"否"
    ];

    protected $GYRUS_WIDTH_INCREASE = [    //沟回宽度增加
        1=>"是",
        2=>"否"
    ];

    protected $VENTRICULOMEGALY = [    //脑室扩大
        1=>"是",
        2=>"否"
    ];

    protected $CAROTID_ATHEROSCLEROTIC_PLAQUE = [    //颈动脉粥样硬化斑块
        1=>"是",
        2=>"否"
    ];

    protected $INTRACRANIAL_VASCULAR_STENOSIS = [    //颅内血管狭窄
        1=>"是",
        2=>"否"
    ];

}