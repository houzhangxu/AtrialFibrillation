<form id="form-update" action="{{ url("hypertension/measure/update/".$measure->id) }}" class="horizontal-form">
<h3 class="form-section">高血压测量</h3>

{{ csrf_field() }}
<input type="hidden" name="Measure[id_card]" value="{{ $patient_info->id_card }}" />

<div class="row-fluid">

    <div class="span6">
        <div class="control-group">

            <label class="control-label">姓名</label>

            <div class="controls">

                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

            </div>
        </div>
    </div>

    <div class="span6 ">

        <div class="control-group">

            <label class="control-label"><span class="required">*</span> 测量时间</label>

            <div class="controls">
                <div class="input-append date form_datetime" data-date="">

                    <input size="16" type="text" name="Measure[measure_time]" value="{{ date("Y-m-d H:i",$measure->measure_time) }}" readonly class="m-wrap">

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

            <label class="control-label">收缩压</label>

            <div class="controls">
                <input type="text" id="" name="Measure[systolic_pressure]" class="m-wrap span12" placeholder="收缩压" value="{{ $measure->systolic_pressure }}">
            </div>

        </div>

    </div>

    <div class="span6 ">

        <div class="control-group">

            <label class="control-label">舒张压</label>

            <div class="controls">
                <input type="text" id="" name="Measure[diastolic_pressure]" class="m-wrap span12" placeholder="舒张压" value="{{ $measure->diastolic_pressure }}">
            </div>

        </div>

    </div>

</div>

</form>

<script>
    var oForm_update = Hmodal.formAJAX({
        id: "#form-update",
        flash: true,
        messages: {
            "Measure[systolic_pressure]": {
                required: '收缩压不能为空!'
            },
            "Measure[diastolic_pressure]": {
                required: '舒张压不能为空!'
            }
        },
        rules: {
            "Measure[systolic_pressure]"	  : {
                required: true
            },
            "Measure[diastolic_pressure]"	  : {
                required: true
            }
        }

    });
</script>