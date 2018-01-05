<form id="form-add" action="{{ url("ThyroidFunction/measure/create") }}" class="horizontal-form">
    <h3 class="form-section">甲状腺功能测量</h3>

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

                <label class="control-label">总甲状腺素nmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[thyroxine]" class="m-wrap span12" placeholder="总甲状腺素nmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">总三碘甲状腺原氨酸nmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[triiodothyronine]" class="m-wrap span12" placeholder="总三碘甲状腺原氨酸nmol/L">
                </div>

            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">第三代促甲状腺素mIU/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[third_generation_thyroid_stimulating_hormone]" class="m-wrap span12" placeholder="第三代促甲状腺素mIU/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">游离甲状腺素</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[free_thyroxine]" class="m-wrap span12" placeholder="游离甲状腺素">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">游离三碘甲状腺原氨酸pmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[free_triiodothyronine]" class="m-wrap span12" placeholder="游离三碘甲状腺原氨酸pmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">甲状腺过氧化物酶抗体IU/mL</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[thyroid_peroxidase_antibody]" class="m-wrap span12" placeholder="甲状腺过氧化物酶抗体IU/mLL">
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