<form id="form-add" action="{{ url("BloodFat/measure/create") }}" class="horizontal-form">
    <h3 class="form-section">血脂测量</h3>

    {{ csrf_field() }}
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

                <label class="control-label">甘油三酯mmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[triglyceride]" class="m-wrap span12" placeholder="甘油三酯mmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">总胆固醇mmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[cholesterol_total]" class="m-wrap span12" placeholder="总胆固醇mmol/L">
                </div>

            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">高密度脂蛋白-Cmmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[high_density_lipoprotein]" class="m-wrap span12" placeholder="高密度脂蛋白-Cmmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">低密度脂蛋白-Cmmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[low_densith_lipoprotein]" class="m-wrap span12" placeholder="低密度脂蛋白-Cmmol/L">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">极低密度脂蛋白-Cmmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[very_low_density_lipoprotein]" class="m-wrap span12" placeholder="极低密度脂蛋白-Cmmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">他汀</label>

                <div class="controls">
                    @foreach($measure->option(-1,"STATIN") as $key => $value)
                        <label class="radio">
                            <input type="radio" name="Measure[statin]" value="{{ $key }}" />
                            {{ $value }}
                        </label>
                    @endforeach
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">剂量mg</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[dose]" class="m-wrap span12" placeholder="剂量mg">
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