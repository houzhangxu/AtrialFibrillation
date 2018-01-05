<form id="form-add" action="{{ url("ArrhythmicDrugs/measure/create") }}" class="horizontal-form">
    <h3 class="form-section">心律失常测量</h3>

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

                <label class="control-label">可达龙</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[amiodaronum]" class="m-wrap span12" placeholder="可达龙">
                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">心律平</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[propafenone]" class="m-wrap span12" placeholder="心律平">
                </div>

            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">美托洛尔缓释片</label>

                <div class="controls">

                    @foreach($measure->option(-1,"ZOK") as $key => $value)
                        <label class="radio">
                            <input type="radio" name="Measure[zok]" value="{{ $key }}" />
                            {{ $value }}
                        </label>
                    @endforeach

                </div>

            </div>

        </div>

        <div class="span6 ">

            <div class="control-group">

                <label class="control-label">剂量</label>

                <div class="controls">
                    <input type="text" id="" name="Measure[dose]" class="m-wrap span12" placeholder="剂量">
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
            "Measure[amiodaronum]": {
                required: '可达龙不能为空!'
            },
            "Measure[propafenone]": {
                required: '心律平不能为空!'
            },
            "Measure[zok]"	  : {
                required: '美托洛尔缓释片'
            }
        },
        rules: {
            "Measure[measure_time]": {
                required: true
            },
            "Measure[amiodaronum]"	  : {
                required: true
            },
            "Measure[propafenone]"	  : {
                required: true
            },
            "Measure[zok]"	  : {
                required: true
            }
        }

    });
</script>