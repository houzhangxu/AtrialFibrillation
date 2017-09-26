<div class="form-horizontal form-view">
    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">姓名:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["name"] ? $patient_info["name"] : "无" }}</span>

                </div>

            </div>

        </div>

        <!--/span-->

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">性别:</label>

                <div class="controls">
                    <span class="text">{{ $patient_info->option($patient_info["sex"],"SEX") }}</span>
                </div>

            </div>

        </div>

        <!--/span-->

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">身份证:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["id_card"] ? $patient_info["id_card"] : "无" }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">第几次介入:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["intervention_num"] }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">入组时间:</label>

                <div class="controls">

                    <span class="text">{{ isset($patient_info["admission_time"]) ? date("Y-m-d",$patient_info["admission_time"]) : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">手册:</label>

                <div class="controls">
                    <span class="text">{{ $patient_info->option($patient_info["manual"],"MANUAL") }}</span>
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">射频:</label>

                <div class="controls">
                    <span class="text">{{ $patient_info->option($patient_info["sex"],"RADIO_FREQUENCY") }}</span>
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">起搏:</label>

                <div class="controls">
                    <span class="text">{{ $patient_info->option($patient_info["pacing"],"PACING") }}</span>
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">房颤类型:</label>

                <div class="controls">
                    <span class="text">{{ $patient_info->option($patient_info["fibrillation"],"FIBRILLATION") }}</span>
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">左心耳封堵:</label>

                <div class="controls">
                    <span class="text">{{ $patient_info->option($patient_info["left_atrial_appendage"],"LEFT_ATRIAL_APPENDAGE") }}</span>
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">住院号:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["hospital_number"] }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">出生日期:</label>

                <div class="controls">

                    <span class="text">{{ isset($patient_info["birth_date"]) && $patient_info["birth_date"]!=0 ? date("Y-m-d",$patient_info["birth_date"]) : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">联系方式1:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["phone1"] ? $patient_info["phone1"] : "无" }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">联系方式2:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["phone2"] ? $patient_info["phone2"] : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">职业:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["career"] ? $patient_info["career"] : "无" }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">婚否:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["ismarry"],"ISMARRY") }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">孩子数量:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["child_num"] ? $patient_info["child_num"] : 0 }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">宗教信仰:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["religious_belief"],"RELIGIOUS_BELIEF") }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">文化程度:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["cultural_level"],"CULTURAL_LEVEL") }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">籍贯:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["native_place"] ? $patient_info["native_place"] : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">睡眠呼吸暂停:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["sleep_apnea"],"SLEEP_APNEA") }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">纽约心功能:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["new_york_heart_function"],"NEW_YORK_HEART_FUNCTION") }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">COPD:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["COPD"],"COPD") }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">结缔组织病史:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["history_of_connective_tissue"],"HISTORY_OF_CONNECTIVE_TISSUE") }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">肿瘤病史:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info->option($patient_info["history_of_cancer"],"HISTORY_OF_CANCER") }}</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">其他疾病:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["other_medical_history"] ? $patient_info["other_medical_history"] : "无" }}</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">身高:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["height"] ? $patient_info["height"] : 0 }} CM</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">体重:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["body_weight"] ? $patient_info["body_weight"] : 0 }} KG</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">腹围:</label>

                <div class="controls">

                    <span class="text">{{  $patient_info["abdominal_circumference"] ? $patient_info["abdominal_circumference"] : 0 }} CM</span>

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">BMI:</label>

                <div class="controls">

                    <span class="text">{{  $patient_info["BMI"] ? $patient_info["BMI"] : 0 }} KG</span>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label" for="lastName">MOCA评分:</label>

                <div class="controls">

                    <span class="text">{{ $patient_info["MOCA"] ? $patient_info["MOCA"] : 0 }} CM</span>

                </div>

            </div>

        </div>

    </div>


</div>