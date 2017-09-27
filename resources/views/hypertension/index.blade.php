@extends("common.layout")

@section("title")
    高血压
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
    高血压
@stop

@section("content-title-more")
    高血压详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="{{ url("") }}">高血压</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>高血压</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("hypertension/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
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

                            <label class="control-label">高血压</label>

                            <div class="controls">
                                @foreach($form->option(-1,"HYPERTENSION") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[hypertension]" value="{{ $key }}" {{ $form["hypertension"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">高血压年数</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" name="Form[hypertension_year]" value="{{ isset($form->hypertension_year) ?$form->hypertension_year:0 }}" class="m-wrap span12"
                                           placeholder="高血压年数" />
                                    <span class="add-on">年</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">最高收缩压血压:</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" name="Form[maximum_systolic_blood_pressure]" value="{{ isset($form->maximum_systolic_blood_pressure) ?$form->maximum_systolic_blood_pressure:0 }}"
                                           class="m-wrap span12" placeholder="最高收缩压血压" />
                                    <span class="add-on">mmHg</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">最高舒张压</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" name="Form[peak_diastolic_pressure]" value="{{ isset($form->peak_diastolic_pressure) ?$form->peak_diastolic_pressure:0 }}"
                                           class="m-wrap span12" placeholder="最高舒张压" />
                                    <span class="add-on">mmHg</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">CCB</label>

                            <div class="controls">
                                @foreach($form->option(-1,"_CCB") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[CCB]" value="{{ $key }}" {{ $form["CCB"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">B-BLOCKER</label>

                            <div class="controls">
                                @foreach($form->option(-1,"_B_BLOCKER") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[B_BLOCKER]" value="{{ $key }}" {{ $form["B_BLOCKER"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">类型</label>

                            <div class="controls">
                                @foreach($form->option(-1,"TYPE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[type]" value="{{ $key }}" {{ $form["type"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">剂量</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" class="m-wrap span12" name="Form[type_dose]" value="{{ isset($form->type_dose) ?$form->type_dose:0 }}" placeholder="剂量">
                                    <span class="add-on">mg</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">ACEI</label>

                            <div class="controls">
                                @foreach($form->option(-1,"_ACEI") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[ACEI]" value="{{ $key }}" {{ $form["ACEI"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">ACEI品种</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ACEI_VARIETIES") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[ACEI_varieties]" value="{{ $key }}" {{ $form["ACEI_varieties"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">ARB</label>

                            <div class="controls">
                                @foreach($form->option(-1,"_ARB") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[ARB]" value="{{ $key }}" {{ $form["ARB"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">ARB品种</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ARB_VARIETIES") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[ARB_varieties]" value="{{ $key }}" {{ $form["ARB_varieties"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">利尿剂</label>

                            <div class="controls">
                                @foreach($form->option(-1,"DIURETIC") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[diuretic]" value="{{ $key }}" {{ $form["diuretic"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">其他降压药</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[other_hypotensor]" value="{{ isset($form->other_hypotensor) ?$form->other_hypotensor:"" }}" placeholder="其他降压药">
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

    </div>
@stop

@section("document-ready")

@stop

@section("footer-script")

    <script>
        jQuery(document).ready(function() {

            //App.init();
            //TableEditable.init();

            //var $modal = $('#ajax-modal');


        });


    </script>
@stop


