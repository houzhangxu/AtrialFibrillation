<form id="form-add" action="{{ url("AtrialFibrillationBurden/measure/create") }}" class="horizontal-form">
    <h3 class="form-section">房颤负荷测量</h3>

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

                <label class="control-label">房颤负荷（小时）</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[load_hour]" class="m-wrap span12" placeholder="房颤负荷（小时）">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">24小时心率</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[heart_rate_day]" class="m-wrap span12" placeholder="24小时心率">
                </div>

            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">房性早搏</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[atrial_premature_beats]" class="m-wrap span12" placeholder="房性早搏">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">室性早搏</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[premature_ventricualr_contraction]" class="m-wrap span12" placeholder="室性早搏">
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
            },
            "Measure[load_hour]": {
                required: '房颤负荷每小时不能为空!'
            },
            "Measure[heart_rate_day]": {
                required: '24小时心率不能为空!'
            },
            "Measure[atrial_premature_beats]"	  : {
                required: '房性早搏不能为空!'
            },
            "Measure[premature_ventricualr_contraction]"	  : {
                required: '室性早搏不能为空!'
            }
        },
        rules: {
            "Measure[measure_time]": {
                required: true
            },
            "Measure[load_hour]": {
                required: true
            },
            "Measure[heart_rate_day]": {
                required: true
            },
            "Measure[atrial_premature_beats]"	  : {
                required: true
            },
            "Measure[premature_ventricualr_contraction]"	  : {
                required: true
            }
        }

    });
</script>