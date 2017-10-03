@extends("common.layout")

@section("title")
    糖尿病
@stop

@section("header")
    @parent
@stop

@section("style")
@stop

@section("sidebar")
    @parent
@stop

@section("patient-name")
    {{ $patient_info->name }}
@stop

@section("content-title")
    糖尿病
@stop

@section("content-title-more")
    糖尿病详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">糖尿病</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>糖尿病</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("Diabetes/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Form[pid]" value="{{ $patient_info->id }}" />
                        <input type="hidden" name="Form[id_card]" value="{{ $patient_info->id_card }}" />

                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">糖尿病</label>

                            <div class="controls">
                                @foreach($form->option(-1,"DIABETES") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[diabetes]" value="{{ $key }}" {{ $form["diabetes"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">病史</label>

                            <div class="controls">
                                    <input type="text" class="m-wrap span12" name="Form[medical_history]" value="{{ isset($form->medical_history) ?$form->medical_history:"" }}" placeholder="病史">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">空腹血糖</label>

                            <div class="controls">
                                <input type="text" name="Form[fasting_plasma_glucose]" value="{{ isset($form->fasting_plasma_glucose) ?$form->fasting_plasma_glucose:"" }}"
                                           class="span12" placeholder="空腹血糖" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">HbA1%</label>

                            <div class="controls">
                                <input type="text" name="Form[HbA1]" value="{{ isset($form->HbA1) ?$form->HbA1:"" }}"
                                       class="span12" placeholder="HbA1" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">HbA1C%</label>

                            <div class="controls">
                                <input type="text" name="Form[HbA1C]" value="{{ isset($form->HbA1C) ?$form->HbA1C:"" }}"
                                       class="span12" placeholder="HbA1C%" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">二甲双胍</label>

                            <div class="controls">
                                <input type="text" name="Form[metformin]" value="{{ isset($form->metformin) ?$form->metformin:"" }}"
                                       class="span12" placeholder="二甲双胍" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">格列美脲</label>

                            <div class="controls">
                                <input type="text" name="Form[glimepiride]" value="{{ isset($form->glimepiride) ?$form->glimepiride:"" }}"
                                       class="span12" placeholder="格列美脲" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">阿卡波糖</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ACARBOSE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[acarbose]" value="{{ $key }}" {{ $form["acarbose"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn blue"><i class="icon-ok"></i> 保存</button>

                        </div>

                    </form>

                    <!-- END FORM-->

                </div>

            </div>

            <!-- END EXAMPLE TABLE PORTLET-->

        </div>

    </div>

    <!-- END PAGE CONTENT -->
@stop

@section("document-ready")

@stop

@section("footer-script")

    <script>
        jQuery(document).ready(function() {

            //App.init();
            //TableEditable.init();

            //var $modal = $('#ajax-modal');

            var oForm = Hmodal.form({
                id: "#oForm",
                messages: {
                    "Form[diabetes]": {
                        required: '糖尿病史为必选项'
                    }
                },
                rules: {
                    "Form[diabetes]": {
                        required: true
                    }
                }

            });

        });


    </script>
@stop


