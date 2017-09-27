<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/9/16
 * Time: 12:02
 */
namespace App;

class PatientInfo extends BaseModel{    //病人信息

    protected $table = "patient_info";   //指定表名
    protected $primaryKey = "id";   //指定主键

    protected $fillable = [
        "id_card","name","sex","admission_time","intervention_num","manual","radio_frequency","pacing","fibrillation","left_atrial_appendage",
        "hospital_number","phone1","phone2","birth_date","career","ismarry","child_num","religious_belief","cultural_level","native_place",
        "sleep_apnea", "new_york_heart_function","COPD","history_of_connective_tissue","history_of_cancer","other_medical_history","height",
        "body_weight","abdominal_circumference","BMI","MOCA"
    ];    //指定允许批量赋值的字段

    public $timestamps = true;   //维护时间戳

    protected $SEX = [    //性别
        1=>"男",
        2=>"女"
    ];

    protected $MANUAL = [ //手册
        1=>"是",
        2=>"否"
    ];

    protected $RADIO_FREQUENCY = [ //射频
        1=>"是",
        2=>"否"
    ];

    protected $PACING = [ //起搏
        1=>"是",
        2=>"否",
        3=>"房速"
    ];

    protected $FIBRILLATION = [ //房颤类型
        1=>"阵发性",
        2=>"持续性"
    ];

    protected $LEFT_ATRIAL_APPENDAGE = [ //左心耳封堵
        1=>"是",
        2=>"否"
    ];

    protected $ISMARRY = [ //婚否
        1=>"是",
        2=>"否"
    ];

    protected $RELIGIOUS_BELIEF = [ //宗教信仰
        0=>"无",
        1=>"基督教",
        2=>"佛教"
    ];

    protected $CULTURAL_LEVEL = [
        1=>"文盲",
        2=>"小学",
        3=>"初中",
        4=>"中专(技校)",
        5=>"高中",
        6=>"大专",
        7=>"大学",
        8=>"研究生",
        9=>"研究生以上"
    ];

    protected $SLEEP_APNEA = [ //睡眠呼吸暂停
        1=>"是",
        2=>"否",
        3=>"有打呼"
    ];

    protected $NEW_YORK_HEART_FUNCTION = [    //纽约心功能
        1=>"是",
        2=>"否"
    ];

    protected $COPD = [ //COPD
        1=>"是",
        2=>"否"
    ];

    protected $HISTORY_OF_CONNECTIVE_TISSUE = [ //结缔组织病史
        1=>"是",
        2=>"否"
    ];

    protected $HISTORY_OF_CANCER = [ //肿瘤病史
        1=>"是",
        2=>"否"
    ];

    public function manual($ind = null){    //示例
        if($ind != null){
            return array_key_exists($ind,$this->MANUAL) ? $this->MANUAL[$ind] : $this->UN;
        }

        return $this->MANUAL;
    }


}