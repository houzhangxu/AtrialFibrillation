<?php
/**
 * Created by PhpStorm.
 * User: 章旭
 * Date: 2017/10/5
 * Time: 15:08
 */

namespace App\Http\Controllers;

use App\FamilyHistory;
use App\PatientInfo;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{   //Excel

    public function import(Request $request){

        if($request->isMethod("POST")){
//            var_dump($_FILES);
            $file = $request->file("file");
           // dump($file);
            $originalName = $file->getClientOriginalName();     //源文件名
            $extensionName = $file->getClientOriginalExtension();   //扩展名
            $type = $file->getClientMimeType();                 //获取文件的类型
            $realPath = $file->getRealPath();                   //临时绝对路径

            $filename = date("Y-m-d-H-i-s") . '_' .uniqid() . '.' . $extensionName;
            //($filename);
            $bool = Storage::disk("excels")->put($filename,file_get_contents($realPath));
            //dump($filename);

            if($bool){
                //dump(storage_path("excels")) ."\\". $filename;
//                $excel = "storage\\app\\excels". '\\' .iconv('UTF-8', 'GBK//IGNORE', $filename) ;
                $excel = "storage\\app\\excels". '\\' . $filename;
                Excel::load($excel,function ($reader){
                    $data = $reader->all();
                    dump($data);
                });
            }

            return view("import.state",[
                "state"=>$bool
            ]);
        }

        return view("import.index");
    }

    public function importTest(){
        $excel = "storage\\app\\excels". '\\' . "2017-12-19-06-12-58_5a38adeadad62.xls";
        Excel::load($excel,function ($reader){
            $reader->setDateColumns(array(
                'admission_time'
            ))->get();

            $data = $reader->all();
            dump($data);

            $data1 = $reader->get();
            dump($data1);

            $data3 = $reader->get()->groupBy("");
            dump($data3);

            $data4 = $reader->first();
            dump($data4);
            dump($data4->first());
            dump($data4->getTitle());


            // Get workbook title
            $workbookTitle = $reader->getTitle();
            dump($workbookTitle);

            foreach($reader->get() as $sheet)
            {
                // get sheet title
//                dump($sheet);
                $sheetTitle = $sheet->getTitle();
//                dump($sheetTitle);
            }

            /*
            $row10 = $reader->takeRows(4)->get();
            dump($row10);
            $col0 = $reader->takeColumns(4)->get();
            dump($col0);
            */

            dump($reader->toArray());
            dump($reader->toObject());


            $reader->each(function($sheet) {

                dump($sheet);
                // Loop through all rows
                $sheet->each(function($row) {
                });

            });

        });

    }

    public function importInsert(){
        $excel = "storage\\app\\excels". '\\' . "2017-12-19-06-12-58_5a38adeadad62.xls";
        Excel::load($excel,function ($reader){

            $reader->each(function($sheet) {

                $title = $sheet->getTitle();

                switch($title){
                    case "一般情况":
                        foreach ($sheet as $key => $row){
                            $sheet[$key]["admission_time"] = strtotime($row["admission_time"]);
                            $sheet[$key]["birth_date"] = strtotime($row["birth_date"]);
                        }
                        dump($sheet);
                        PatientInfo::insert($sheet->toArray());
                        break;
                }

            });


        });
    }


    public function main(){ //我是主函数
        $number1 = 11; //假装从键盘获取了数字
        $number2 = -11; //假装从键盘获取了数字

        $this->calc($number1,$number2);  //把获取的数字传入自定义的函数

        return 0;
    }

    public function calc($number1,$number2){ //我是自定义的函数
        $sum =abs($number1) + abs($number2);    //计算和
        $sub =abs($number1) - abs($number2);    //计算差

        print("和:" . $sum . ",差:" . $sub);     //输出

    }

    public function export(){

        //一般情况
        $patientinfos = PatientInfo::select(
            "name as 姓名",
            "id_card as 身份证",
            "admission_time as 入组时间",
            "intervention_num as 第几次介入",
            "manual as 手册",
            "radio_frequency as 射频",
            "pacing as 起搏",
            "fibrillation as 房颤类型",
            "left_atrial_appendage as 左心耳封堵",
            "hospital_number as 住院号",
            "phone1 as 联系方式1",
            "phone2 as 联系方式2",
            "sex as 性别",
            "birth_date as 出生年月",
            "career as 职业",
            "ismarry as 婚否",
            "child_num as 几个孩子",
            "religious_belief as 宗教信仰",
            "cultural_level as 文化程度",
            "native_place as 籍贯",
            "sleep_apnea as 睡眠呼吸暂停",
            "new_york_heart_function as 纽约心功能",
            "COPD",
            "history_of_connective_tissue as 结缔组织病史",
            "history_of_cancer as 肿瘤病史",
            "uremia as 尿毒症",
            "hepatitis_B as 乙肝",
            "hepatic_adipose_infiltration as 脂肪肝",
            "hyperthyreosis as 甲亢",
            "hypothyroidism as 甲减",
            "other_medical_history as 其他疾病","height as 身高",
            "body_weight as 体重",
            "abdominal_circumference as 腹围",
            "BMI",
            "MOCA as MOCA评分"
        )->orderBy("入组时间","desc")
            ->get();
        foreach ($patientinfos as $patientinfo){    //对从数据库中取出的数据进行处理
            $patientinfo["入组时间"] = isset($patientinfo["入组时间"]) ? date("Y-m-d",$patientinfo["入组时间"]) : "";
            $patientinfo["出生年月"] = isset($patientinfo["出生年月"]) ? date("Y-m-d",$patientinfo["出生年月"]) : "";
            $patientinfo["身份证"] = "=\"".$patientinfo["身份证"]."\"";
        }

        //家庭史
        $familys = DB::table("patient_info as p")->leftJoin("family_history as t","p.id_card","t.id_card")->select(
            "p.name as 姓名",
            "p.id_card as 身份证",
            "father as 父亲",
            "mother as 母亲",
            "brother as 兄弟",
            "sisters as 姐妹",
            "son as 儿子",
            "daughter as 女儿"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($familys as $key => $item){    //对从数据库中取出的数据进行处理
            $item->身份证 = "=\"".$item->身份证."\"";
        }

        //抽烟喝酒
        $sds = DB::table("patient_info as p")->leftJoin("smoke_drink as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "drink",
            "drink_type",
            "ml",
            "drink_year",
            "quit_drink",
            "quit_drink_year",
            "smoke",
            "somke_few",
            "smoke_year",
            "quit_smoke",
            "quit_smoke_year"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($sds as $item){    //对从数据库中取出的数据进行处理
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //高血压
        $hypertensions = DB::table("patient_info as p")->leftJoin("hypertension as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "hypertension",
            "hypertension_year",
            "maximum_systolic_blood_pressure",
            "peak_diastolic_pressure",
            "CCB",
            "B_BLOCKER",
            "type",
            "type_dose",
            "ACEI",
            "ACEI_varieties",
            "ARB",
            "ARB_varieties",
            "diuretic",
            "other_hypotensor"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($hypertensions as $item){    //对从数据库中取出的数据进行处理
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //冠心病
        $chds = DB::table("patient_info as p")->leftJoin("coronary_heart_disease as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "coronary_heart_disease",
            "stent_implantation",
            "coronary_artery_stenosis",
            "statin",
            "aspirin",
            "polivy"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($chds as $item){    //对从数据库中取出的数据进行处理
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //脑卒中
        $cps = DB::table("patient_info as p")->leftJoin("cerebral_apoplexy as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "cerebral_apoplexy",
            "medical_history",
            "MRI_ischemic_focus",
            "position",
            "num",
            "gyrus_width_increase",
            "ventriculomegaly",
            "carotid_atherosclerotic_plaque",
            "patch_size",
            "intracranial_vascular_stenosis"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($cps as $item){    //对从数据库中取出的数据进行处理
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //抗凝方案
        $ars = DB::table("patient_info as p")->leftJoin("anticoagulant_regimen as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "anti_freezing",
            "xarelto_dose",
            "CHADS2",
            "CHA2DS2_VASC",
            "HASBLED"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($ars as $item){    //对从数据库中取出的数据进行处理
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //心律失常药物 测量
        $adms = DB::table("patient_info as p")->join("arrhythmic_drugs_measure as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "amiodaronum",
            "propafenone",
            "zok",
            "dose",
            "measure_time"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($adms as $item){
            $item->measure_time = isset($item->measure_time) ? date("Y-m-d H:i",$item->measure_time) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //房颤负荷 测量
        $afbms = DB::table("patient_info as p")->join("atrial_fibrillation_burden_measure as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "load_hour",
            "heart_rate_day",
            "atrial_premature_beats",
            "premature_ventricualr_contraction",
            "measure_time"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($afbms as $item){
            $item->measure_time = isset($item->measure_time) ? date("Y-m-d H:i",$item->measure_time) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //糖尿病
        $diabeteses = DB::table("patient_info as p")->leftJoin("diabetes as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "diabetes",
            "medical_history",
            "fasting_plasma_glucose",
            "HbA1",
            "HbA1C",
            "metformin",
            "glimepiride",
            "acarbose"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($diabeteses as $item){
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //肾功能不全 测量
        $rims = DB::table("patient_info as p")->join("renal_inadequacy_measure as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "serum_creatinine",
            "egfr",
            "CKD",
            "CY_C",
            "uric_acid",
            "usea_nitrogen",
            "homocysteine",
            "urine_protein",
            "bld",
            "urinary_PH",
            "specific_gravity_of_urine",
            "measure_time"
        )->orderBy("p.admission_time","desc")
            ->get();

        foreach ($rims as $item){
            $item->measure_time = isset($item->measure_time) ? date("Y-m-d H:i",$item->measure_time) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }


        //甲状腺功能 测量
        $tfms = DB::table("patient_info as p")->join("thyroid_function_measure as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "thyroxine",
            "triiodothyronine",
            "third_generation_thyroid_stimulating_hormone",
            "free_thyroxine",
            "free_triiodothyronine",
            "thyroid_peroxidase_antibody",
            "measure_time"
        )->orderBy("p.admission_time","desc")
            ->get();

        foreach ($tfms as $item){
            $item->measure_time = isset($item->measure_time) ? date("Y-m-d H:i",$item->measure_time) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }


        //肝功能不全 测量
        $his = DB::table("patient_info as p")->join("hepatic_insufficiency_measure as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "total_protein",
            "albumin",
            "globulin",
            "globulin_proportion",
            "glutamic_pyruvic_transaminase",
            "aspartate_transaminase",
            "total_bilirubin",
            "bilirubin_direct",
            "indirect_bilirubin",
            "hepatinica",
            "measure_time"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($his as $item){
            $item->measure_time = isset($item->measure_time) ? date("Y-m-d H:i",$item->measure_time) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }


        //生殖激素
        $rhs = DB::table("patient_info as p")->leftJoin("reproductive_hormone as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "testosterone",
            "estradiol",
            "follicule_stimulating_hormone",
            "luteinizing_hormone",
            "prolactin",
            "progesterone"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($rhs as $item){
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //BNP等
        $bnps = DB::table("patient_info as p")->leftJoin("bnp as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "bnp",
            "TNI",
            "CK",
            "CK_MB",
            "CRP"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($bnps as $item){
            $item->id_card = "=\"".$item->id_card."\"";
        }


        //血脂 测量
        $blood_fats = DB::table("patient_info as p")->join("blood_fat as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "triglyceride",
            "cholesterol_total",
            "high_density_lipoprotein",
            "low_densith_lipoprotein",
            "very_low_density_lipoprotein",
            "statin",
            "dose",
            "measure_time"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($blood_fats as $item){
            $item->measure_time = isset($item->measure_time) ? date("Y-m-d H:i",$item->measure_time) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //手术参数
        $operations = DB::table("patient_info as p")->leftJoin("operation as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "doctor",
            "first_assistant",
            "operation_mode",
            "add_melt",
            "operation_time",
            "efferent_block",
            "pulmonary_vein",
            "afferent_block",
            "bleeding_volume",
            "electric_repetition_rate",
            "amiodaronum",
            "pericardial_tamponade",
            "heparin",
            "fentanyl",
            "intraoperative_vagal_reflex_hypotension",
            "atropine",
            "dopamine",
            "other_complications",
            "left_atrial_manometry_before_ablation",
            "left_atrial_manometry_after_ablation",
            "left_atrial_manometry_atrial_fibrillation",
            "left_atrial_manometry_sinus"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($operations as $item){
            $item->id_card = "=\"".$item->id_card."\"";
        }

        //住院费用参数
        $hps = DB::table("patient_info as p")->leftJoin("hospitalization_expenses as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "cost",
            "medical_insurance_amount",
            "self_amount",
            "western_medicine_fee",
            "treatment_fee",
            "material_cost",
            "nursing_fee",
            "special_fee",
            "laboratory_fee",
            "laboratory_material",
            "inspection_fee",
            "check_material_cost",
            "bed_fee",
            "hospital_stay",
            "medical_insurance",
            "medical_insurance_where"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($operations as $item){
            $item->id_card = "=\"".$item->id_card."\"";
        }


        //房颤复发情况
        $relapses = DB::table("patient_info as p")->leftJoin("relapse as t","p.id_card","t.id_card")->select(
            "p.name",
            "p.id_card",
            "relapse_date",
            "duration",
            "stop_method",
            "write_manual",
            "blood_pressure_load",
            "mean_blood_pressure",
            "average_heart_rate",
            "heart_rate_lt_60",
            "heart_rate_gte_61_lte_70",
            "heart_rate_gte_71_lte_80",
            "heart_rate_gte_81_lte_90",
            "heart_rate_gt_91"
        )->orderBy("p.admission_time","desc")
            ->get();
        foreach ($relapses as $item){
            $item->relapse_date = isset($item->relapse_date) ? date("Y-m-d H:i",$item->relapse_date) : "";
            $item->id_card = "=\"".$item->id_card."\"";
        }

        Excel::create('病人信息',function($excel) use ($patientinfos,$familys,$sds,$hypertensions,$chds,$cps,$ars,$adms,$afbms,$diabeteses,$rims,$tfms,$his,$rhs,$bnps,$blood_fats,$operations,$hps,$relapses){  //创建excel
            $excel->sheet("一般情况", function($sheet) use ($patientinfos){    //创建excel中的一个表格
                $sheet->fromModel($patientinfos);
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("家族史",function($sheet) use ($familys){
                $sheet->rows($this->formatTable($familys));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("抽烟喝酒",function($sheet) use ($sds){
                $sdKeyNames = ["姓名","身份证","喝酒史（1=是，2=否）","喝酒品种（1=白酒，2=黄酒，3=红酒，4=啤酒）",
                    "每天的量（ml）","喝了几年","是否戒（1=是，2=否）","戒了几年","抽烟史（1=是，2=否）",
                    "每天多少支","抽了几年","是否戒（1=是，2=否）","戒了几年"];
                $sheet->rows($this->formatTable($sds,$sdKeyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("高血压",function($sheet) use ($hypertensions){
                $keyNames = ["姓名","身份证","高血压（1=是，2=否）","几年","最高收缩压血压","最高舒张压","CCB（1=是，2=否）","B-BLOCKER（1=是，2=否）","类型（）","剂量（mg）","ACEI（1=是，2=否）",
                    "品种","ARB（1=是，2=否）","品种","利尿剂（1=是，2=否）","其他降压药"];
                $sheet->rows($this->formatTable($hypertensions,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("冠心病",function($sheet) use ($chds){
                $keyNames = ["姓名","身份证","冠心病史（1=是，2=否）","是否支架植入（1=是，2=否）","冠状动脉狭窄","他汀","阿司匹林（1=是，2=否）","波利维（1=是，2=否）"];
                $sheet->rows($this->formatTable($chds,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("脑卒中",function($sheet) use ($cps){
                $keyNames = ["姓名","身份证","脑卒中（1=是，2=否）","病史","MRI缺血灶（1=是，2=否）","部位","数量","沟回宽度增加（1=是，2=否）","脑室扩大（1=是，2=否）",
                    "颈动脉粥样硬化斑块（1=是，2=否）","斑块大小","颅内血管狭窄（1=是，2=否）"];
                $sheet->rows($this->formatTable($cps,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("抗凝方案",function($sheet) use ($ars){
                $keyNames = ["姓名","身份证","抗凝方案（1=华法令，2=拜瑞妥,3=阿司匹林）","拜瑞妥剂量(mg)","CHADS2","CHA2DS2-VASC","HASBLED"];
                $sheet->rows($this->formatTable($ars,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("心律失常药物",function($sheet) use ($adms){
                $keyNames = ["姓名","身份证","可达龙（g）","心律平(mg)","美托洛尔缓释片","剂量","测量时间"];
                $sheet->rows($this->formatTable($adms,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("房颤负荷",function($sheet) use ($afbms){
                $keyNames = ["姓名","身份证","房颤负荷（小时）","24小时心率","房性早搏","室性早搏","测量时间"];
                $sheet->rows($this->formatTable($afbms,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("糖尿病",function($sheet) use ($diabeteses){
                $keyNames = ["姓名","身份证","糖尿病（1=是，2=否）","病史","空腹血糖","HbA1%","HbA1C%","二甲双胍","格列美脲","阿卡波糖(卡博平片) "];
                $sheet->rows($this->formatTable($diabeteses,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("肾功能不全",function($sheet) use ($rims){
                $keyNames = ["姓名","身份证","血肌酐","egfr","CKD","CY-C","尿酸","尿素氮","同行半胱氨酸","尿蛋白g/l","尿隐血mg/L","尿PH","尿比重","测量时间"];
                $sheet->rows($this->formatTable($rims,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("甲状腺功能",function($sheet) use ($tfms){
                $keyNames = ["姓名","身份证","总甲状腺素nmol/L","总三碘甲状腺原氨酸nmol/L","第三代促甲状腺素mIU/L","游离甲状腺素","游离三碘甲状腺原氨酸pmol/L","甲状腺过氧化物酶抗体IU/mL","测量时间"];
                $sheet->rows($this->formatTable($tfms,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("肝功能不全",function($sheet) use ($his){
                $keyNames = ["姓名","身份证","总蛋白g/L","白蛋白g/L","球蛋白g/L","白球蛋白比例","谷丙转氨酶U/L","谷草转氨酶U/L","总胆红素μmol/L","直接胆红素μmol/L","间接胆红素μmol/L","护肝药（1=是，2=否）","测量时间"];
                $sheet->rows($this->formatTable($his,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("生殖激素",function($sheet) use ($rhs){
                $keyNames = ["姓名","身份证","睾酮ng/dl","雌二醇pg/ml","卵泡刺激素mIU/mL","黄体生成素mIU/mL","泌乳素ng/ml","孕酮ng/ml"];
                $sheet->rows($this->formatTable($rhs,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("BNP等",function($sheet) use ($bnps){
                $keyNames = ["姓名","身份证","BNPpg/Ml","TNI定量（ng/mL）","CK（U/L）","CK-MB（U/L）","CRPmg/L"];
                $sheet->rows($this->formatTable($bnps,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("血脂",function($sheet) use ($blood_fats){
                $keyNames = ["姓名","身份证","甘油三酯mmol/L","总胆固醇mmol/L","高密度脂蛋白-Cmmol/L","低密度脂蛋白-Cmmol/L",
                    "极低密度脂蛋白-Cmmol/L","他汀（0=无，1=立普妥，2=舒降之，3=可定，4=依折麦布）","剂量mg","测量时间"];
                $sheet->rows($this->formatTable($blood_fats,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("手术参数",function($sheet) use ($operations){
                $keyNames = ["姓名","身份证","手术医生(1-陶，2=郑)","一助（1=周，2=张）","手术方式（1=消融，2=冷冻球）",
                    "是否附加线消融0=无，1=三尖瓣，2=二尖瓣环，3=房顶线，4=碎裂电位）","手术时间","传出阻滞（1=是，2=否）",
                    "肺静脉电位消失（1=是，2=否）","传入阻滞（1=是，2=否）","出血量（ml）","是否电复率（1=是，2=否）","可达龙mg",
                    "心包填塞（1=是，2=否）","肝素（U）","芬太尼（mg）","术中迷走反射低血压（1=是，2=否）","阿托品（mg）",
                    "多巴胺(mg)","其他并发症","左房测压消融前","左房测压消融后","左房测压房颤","左房测压窦性"];
                $sheet->rows($this->formatTable($operations,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("住院费用参数",function($sheet) use ($hps){
                $keyNames = ["姓名","身份证","住院费用","医保金额","自负金额","西药费","治疗费","材料费","护理费","特护费","化验费",
                    "化验材料","检查费","检查材料费","床位费","住院时间","是否医保（1=是，2=否）","哪里医保"];
                $sheet->rows($this->formatTable($hps,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            $excel->sheet("房颤复发情况",function($sheet) use ($relapses){
                $keyNames = ["姓名","身份证","复发时间（年月日）","持续时间（大于48小时用p表示）","怎么停止（1=自行，2=药物，3=电复率）",
                    "是否填手册（1=是，2=否）","血压负荷","平均血压","平均心率","心率（小于60）","心率（61-70）","心率（71-80）","心率（81-90）","心率（大于91）"];
                $sheet->rows($this->formatTable($relapses,$keyNames));
                $sheet->setWidth(["A"=> 10]);
            });

            /*
            //使用视图输出
            $excel->sheet("信息",function($sheet) use ($familys){
                $sheet->loadView("excel.table",["title"=>"信息","result"=>$familys]);
            });
            */


        })->export('xls');
    }

    public function export1(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){  //创建excel
            $excel->sheet('score', function($sheet) use ($cellData){    //创建excel中的一个表格
                $sheet->rows($cellData);
            });


        })->export('xls');
    }

    public function view(){
        $f = DB::table("patient_info as p")->leftJoin("family_history as f","p.id_card","f.pid")->select("p.id as id","p.id_card as 身份证","f.father as father")->get();

        $table = $this->formatTable($f);
        dump($table);
        //return view("excel.table",["result"=>$f]);
    }

    public function formatTable($c,$keyNmaes = null){
        if($c->isEmpty()){
            $temp[] = $keyNmaes;
            return $temp;
        }

        $keys = array_keys(get_object_vars($c[0]));

        if($keyNmaes == null){
            $table[] = $keys;
        }else{
            $table[] = $keyNmaes;
        }

        foreach ($c as $item){
            $t = [];
            foreach ($keys as $key){
                $t[] = $item->$key;
            }
            $table[] = $t;
        }
        return $table;
    }


}