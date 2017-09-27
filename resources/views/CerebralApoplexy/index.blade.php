@extends("common.layout")

@section("title")
    脑卒中
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
    脑卒中
@stop

@section("content-title-more")
    脑卒中详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">脑卒中</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>脑卒中</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("CerebralApoplexy/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
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

                            <label class="control-label">脑卒中史</label>

                            <div class="controls">
                                @foreach($form->option(-1,"CEREBRAL_APOPLEXY") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[cerebral_apoplexy]" value="{{ $key }}" {{ $form["cerebral_apoplexy"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">病史:</label>

                            <div class="controls">
                                <input type="text" name="Form[medical_history]" value="{{ isset($form->medical_history) ?$form->medical_history:"" }}"
                                           class="span12" placeholder="病史" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">MRI缺血灶</label>

                            <div class="controls">
                                @foreach($form->option(-1,"MRI_ISCHEMIC_FOCUS") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[MRI_ischemic_focus]" value="{{ $key }}" {{ $form["MRI_ischemic_focus"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">部位:</label>

                            <div class="controls">
                                <input type="text" name="Form[position]" value="{{ isset($form->position) ?$form->position:"" }}"
                                           class="span12" placeholder="部位" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">数量</label>

                            <div class="controls">
                                <input type="text" name="Form[num]" value="{{ isset($form->num) ?$form->num:0 }}"
                                       class="span12" placeholder="数量" />
                            </div>

                        </div>


                        <div class="control-group">

                            <label class="control-label">沟回宽度增加</label>

                            <div class="controls">
                                @foreach($form->option(-1,"GYRUS_WIDTH_INCREASE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[gyrus_width_increase]" value="{{ $key }}" {{ $form["gyrus_width_increase"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">脑室扩大</label>

                            <div class="controls">
                                @foreach($form->option(-1,"VENTRICULOMEGALY") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[ventriculomegaly]" value="{{ $key }}" {{ $form["ventriculomegaly"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">颈动脉粥样硬化斑块</label>

                            <div class="controls">
                                @foreach($form->option(-1,"CAROTID_ATHEROSCLEROTIC_PLAQUE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[carotid_atherosclerotic_plaque]" value="{{ $key }}" {{ $form["carotid_atherosclerotic_plaque"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">斑块大小</label>

                            <div class="controls">
                                <input type="text" name="Form[patch_size]" value="{{ isset($form->patch_size) ?$form->patch_size:"" }}"
                                       class="span12" placeholder="斑块大小" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">颅内血管狭窄</label>

                            <div class="controls">
                                @foreach($form->option(-1,"INTRACRANIAL_VASCULAR_STENOSIS") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[intracranial_vascular_stenosis]" value="{{ $key }}" {{ $form["intracranial_vascular_stenosis"] == $key ? "checked" : "" }} />
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
                    "Form[cerebral_apoplexy]": {
                        required: '脑卒中史为必选项'
                    },
                    "Form[num]":{
                        digits:"数量必须为整数"
                    }
                },
                rules: {
                    "Form[cerebral_apoplexy]": {
                        required: 100
                    },
                    "Form[num]":{
                        digits:true
                    }
                }

            });

        });


    </script>
@stop


