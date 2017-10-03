<form id="form-add" action="{{ url("HepaticInsufficiency/measure/create") }}" class="horizontal-form">
    <h3 class="form-section">肝功能不全测量</h3>

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

                <label class="control-label">总蛋白g/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[total_protein]" class="m-wrap span12" placeholder="总蛋白g/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">白蛋白g/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[albumin]" class="m-wrap span12" placeholder="白蛋白g/L">
                </div>

            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">球蛋白g/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[globulin]" class="m-wrap span12" placeholder="球蛋白g/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">白球蛋白比例</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[globulin_proportion]" class="m-wrap span12" placeholder="白球蛋白比例">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">谷丙转氨酶U/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[glutamic_pyruvic_transaminase]" class="m-wrap span12" placeholder="谷丙转氨酶U/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">谷草转氨酶U/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[aspartate_transaminase]" class="m-wrap span12" placeholder="谷草转氨酶U/L">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">总胆红素μmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[total_bilirubin]" class="m-wrap span12" placeholder="总胆红素μmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">直接胆红素μmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[bilirubin_direct]" class="m-wrap span12" placeholder="直接胆红素μmol/L">
                </div>

            </div>

        </div>

    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">间接胆红素μmol/L</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[indirect_bilirubin]" class="m-wrap span12" placeholder="间接胆红素μmol/L">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">护肝药</label>

                <div class="controls">
                    @foreach($measure->option(-1,"HEPATINICA") as $key => $value)
                        <label class="radio">
                            <input type="radio" name="Measure[hepatinica]" value="{{ $key }}" />
                            {{ $value }}
                        </label>
                    @endforeach
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