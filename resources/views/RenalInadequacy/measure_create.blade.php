<form id="form-add" action="{{ url("RenalInadequacy/measure/create") }}" class="horizontal-form">
    <h3 class="form-section">肾功能不全测量</h3>

    {{ csrf_field() }}
    <input type="hidden" name="Measure[pid]" value="{{ $patient_info->id }}" />
    <input type="hidden" name="Measure[id_card]" value="{{ $patient_info->id_card }}" />

    <div class="row-fluid">

        <dic class="span6">
            <div class="control-group">

                <label class="control-label">姓名</label>

                <div class="controls">

                    <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                </div>
            </div>
        </dic>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label"><span class="required">*</span> 测量时间</label>

                <div class="controls">
                    <div class="input-append date form_datetime" data-date="">

                        <input size="16" type="text" name="Measure[measure_time]" value="" readonly class="m-wrap">

                        <span class="add-on"><i class="icon-remove"></i></span>

                        <span class="add-on"><i class="icon-calendar"></i></span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">血肌酐</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[serum_creatinine]" class="m-wrap span12" placeholder="血肌酐">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">egfr</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[egfr]" class="m-wrap span12" placeholder="egfr">
                </div>

            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">CKD</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[CKD]" class="m-wrap span12" placeholder="CKD">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">CY-C</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[CY_C]" class="m-wrap span12" placeholder="CY-C">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">尿酸</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[uric_acid]" class="m-wrap span12" placeholder="尿酸">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">尿素氮</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[usea_nitrogen]" class="m-wrap span12" placeholder="尿素氮">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">同行半胱氨酸</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[homocysteine]" class="m-wrap span12" placeholder="同行半胱氨酸">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">尿蛋白</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[urine_protein]" class="m-wrap span12" placeholder="尿蛋白">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">尿隐血</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[bld]" class="m-wrap span12" placeholder="尿隐血">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">尿PH</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[urinary_PH]" class="m-wrap span12" placeholder="尿PH">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">尿比重</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[specific_gravity_of_urine]" class="m-wrap span12" placeholder="尿比重">
                </div>

            </div>

        </div>

    </div>

</form>

<script>
    var oForm_add = Hmodal.formAJAX({
        id: "#form-add",
        flash: true,
        messages: {
            "Measure[measure_time]": {
                required: '测量时间不能为空!'
            }
        },
        rules: {
            "Measure[measure_time]": {
                required: true
            }
        }

    });
</script>