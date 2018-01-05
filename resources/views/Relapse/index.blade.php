@extends("common.layout")

@section("title")
    房颤复发情况
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
    房颤复发情况
@stop

@section("content-title-more")
    房颤复发情况详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">房颤复发情况</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>房颤复发情况</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("Relapse/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Form[id_card]" value="{{ $patient_info->id_card }}" />

                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">复发时间</label>

                            <div class="controls">
                                <div class="input-append date date-picker" data-date="" data-date-format="yyyy-mm-dd" data-date-viewmode="" data-date-minviewmode="">

                                    <input class="m-wrap m-ctrl-medium date-picker" name="Form[relapse_date]" value="{{ isset($form["relapse_date"])?date("Y-m-d",$form["relapse_date"]):"" }}" readonly size="16" type="text" value="" /><span class="add-on"><i class="icon-calendar"></i></span>

                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">持续时间</label>

                            <div class="controls">
                                <input type="text" name="Form[duration]" value="{{ isset($form->duration) ?$form->duration:"" }}"
                                           class="span12" placeholder="持续时间" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">怎么停止</label>

                            <div class="controls">
                                @foreach($form->option(-1,"STOP_METHOD") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[stop_method]" value="{{ $key }}" {{ $form["stop_method"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否填写手册</label>

                            <div class="controls">
                                @foreach($form->option(-1,"WRITE_MANUAL") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[write_manual]" value="{{ $key }}" {{ $form["write_manual"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">血压负荷</label>

                            <div class="controls">
                                <input type="text" name="Form[blood_pressure_load]" value="{{ isset($form->blood_pressure_load) ?$form->blood_pressure_load:"" }}"
                                       class="span12" placeholder="血压负荷" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">平均血压</label>

                            <div class="controls">
                                <input type="text" name="Form[mean_blood_pressure]" value="{{ isset($form->mean_blood_pressure) ?$form->mean_blood_pressure:"" }}"
                                       class="span12" placeholder="平均血压" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">平均心率</label>

                            <div class="controls">
                                <input type="text" name="Form[average_heart_rate]" value="{{ isset($form->average_heart_rate) ?$form->average_heart_rate:"" }}"
                                       class="span12" placeholder="平均心率" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">心率（小于60）</label>

                            <div class="controls">
                                <input type="text" name="Form[heart_rate_lt_60]" value="{{ isset($form->heart_rate_lt_60) ?$form->heart_rate_lt_60:"" }}"
                                       class="span12" placeholder="心率（小于60）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">心率（61-70）</label>

                            <div class="controls">
                                <input type="text" name="Form[heart_rate_gte_61_lte_70]" value="{{ isset($form->heart_rate_gte_61_lte_70) ?$form->heart_rate_gte_61_lte_70:"" }}"
                                       class="span12" placeholder="心率（61-70）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">心率（71-80）</label>

                            <div class="controls">
                                <input type="text" name="Form[heart_rate_gte_71_lte_80]" value="{{ isset($form->heart_rate_gte_71_lte_80) ?$form->heart_rate_gte_71_lte_80:"" }}"
                                       class="span12" placeholder="心率（71-80）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">心率（81-90）</label>

                            <div class="controls">
                                <input type="text" name="Form[heart_rate_gte_81_lte_90]" value="{{ isset($form->heart_rate_gte_81_lte_90) ?$form->heart_rate_gte_81_lte_90:"" }}"
                                       class="span12" placeholder="心率（81-90）" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">心率（大于91）</label>

                            <div class="controls">
                                <input type="text" name="Form[heart_rate_gt_91]" value="{{ isset($form->heart_rate_gt_91) ?$form->heart_rate_gt_91:"" }}"
                                       class="span12" placeholder="心率（大于91）" />
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
                },
                rules: {
                }

            });

        });


    </script>
@stop


