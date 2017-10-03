<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/3
 * Time: 22:25
 */

namespace App;


class Operation extends BaseModel
{   //手术参数
    protected $table = "operation";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = ["id_card","pid","doctor","first_assistant","operation_mode","add_melt","operation_time",
        "efferent_block","pulmonary_vein","afferent_block","bleeding_volume","electric_repetition_rate","amiodaronum",
        "pericardial_tamponade","heparin", "fentanyl","intraoperative_vagal_reflex_hypotension","atropine","dopamine",
        "other_complications", "left_atrial_manometry_before_ablation","left_atrial_manometry_after_ablation",
        "left_atrial_manometry_atrial_fibrillation","left_atrial_manometry_sinus"];

    protected $DOCTOR = [   //医生
        1=>"陶",
        2=>"郑"
    ];

    protected $FIRST_ASSISTANT = [   //一助
        1=>"周",
        2=>"张"
    ];

    protected $OPERATION_MODE = [   //手术方式
        1=>"消融",
        2=>"冷冻求"
    ];

    protected $ADD_MELT = [   //是否附加线消融
        0=>"无",
        1=>"三尖瓣",
        2=>"二尖瓣环",
        3=>"房顶线",
        4=>"碎裂电位"
    ];

    protected $EFFERENT_BLOCK = [   //传出阻滞
        1=>"是",
        2=>"否"
    ];

    protected $PULMONARY_VEIN = [   //肺静脉电位消失
        1=>"是",
        2=>"否"
    ];

    protected $AFFERENT_BLOCK = [   //传入阻滞
        1=>"是",
        2=>"否"
    ];

    protected $ELECTRIC_REPETITION_RATE = [   //是否电复率
        1=>"是",
        2=>"否"
    ];

    protected $PERICARDIAL_TAMPONADE = [   //心包填塞
        1=>"是",
        2=>"否"
    ];

    protected $INTRAOPERATIVE_VAGAL_REFLEX_HYPOTENSION = [   //术中迷走反射低血压
        1=>"是",
        2=>"否"
    ];



}