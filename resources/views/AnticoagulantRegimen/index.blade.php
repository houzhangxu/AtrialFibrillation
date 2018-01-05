@extends("common.layout")

@section("title")
    抗凝方案
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
    抗凝方案
@stop

@section("content-title-more")
    抗凝方案详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">抗凝方案</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>抗凝方案</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("AnticoagulantRegimen/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Form[id_card]" value="{{ $patient_info->id_card }}" />

                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">抗凝方案</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ANTI_FREEZING") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[anti_freezing]" value="{{ $key }}" {{ $form["anti_freezing"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">拜瑞妥剂量(mg)</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" class="m-wrap span12" name="Form[xarelto_dose]" value="{{ isset($form->xarelto_dose) ?$form->xarelto_dose:0 }}" placeholder="拜瑞妥剂量">
                                    <span class="add-on">mg</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">CHADS2</label>

                            <div class="controls">
                                <input type="text" name="Form[CHADS2]" value="{{ isset($form->CHADS2) ?$form->CHADS2:"" }}"
                                           class="span12" placeholder="CHADS2" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">CHA2DS2-VASC</label>

                            <div class="controls">
                                <input type="text" name="Form[CHA2DS2_VASC]" value="{{ isset($form->CHA2DS2_VASC) ?$form->CHA2DS2_VASC:"" }}"
                                       class="span12" placeholder="CHA2DS2_VASC" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">HASBLED</label>

                            <div class="controls">
                                <input type="text" name="Form[HASBLED]" value="{{ isset($form->HASBLED) ?$form->HASBLED:"" }}"
                                       class="span12" placeholder="HASBLED" />
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

            var oForm = Hmodal.form({
                id: "#oForm",
                messages: {
                    "Form[anti_freezing]": {
                        required: '抗凝方案史为必选项'
                    },
                    "Form[num]":{
                        digits:"数量必须为整数"
                    }
                },
                rules: {
                    "Form[anti_freezing]": {
                        required: true
                    },
                    "Form[num]":{
                        digits:true
                    }
                }

            });

        });


    </script>
@stop


