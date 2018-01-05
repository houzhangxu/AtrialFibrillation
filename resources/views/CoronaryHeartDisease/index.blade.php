@extends("common.layout")

@section("title")
    冠心病
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
    冠心病
@stop

@section("content-title-more")
    冠心病详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">冠心病</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>冠心病</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("CoronaryHeartDisease/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Form[id_card]" value="{{ $patient_info->id_card }}" />

                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">冠心病史</label>

                            <div class="controls">
                                @foreach($form->option(-1,"CORONARY_HEART_DISEASE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[coronary_heart_disease]" value="{{ $key }}" {{ $form["coronary_heart_disease"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否支架植入</label>

                            <div class="controls">
                                @foreach($form->option(-1,"STENT_IMPLANTATION") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[stent_implantation]" value="{{ $key }}" {{ $form["stent_implantation"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">冠状动脉狭窄:</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" name="Form[coronary_artery_stenosis]" value="{{ isset($form->coronary_artery_stenosis) ?$form->coronary_artery_stenosis:0 }}"
                                           class="m-wrap span12" placeholder="冠状动脉狭窄" />
                                    <span class="add-on">%</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">他汀</label>

                            <div class="controls">
                                @foreach($form->option(-1,"STATIN") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[statin]" value="{{ $key }}" {{ $form["statin"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>


                        <div class="control-group">

                            <label class="control-label">阿司匹林</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ASPIRIN") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[aspirin]" value="{{ $key }}" {{ $form["aspirin"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">波利维</label>

                            <div class="controls">
                                @foreach($form->option(-1,"POLIVY") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[polivy]" value="{{ $key }}" {{ $form["polivy"] == $key ? "checked" : "" }} />
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
                    "Form[coronary_heart_disease]":{
                        required: '冠心病史不能为空'
                    },
                    "Form[coronary_artery_stenosis]": {
                        max: '不能大于100'
                    }
                },
                rules: {
                    "Form[coronary_heart_disease]":{
                        required: true
                    },
                    "Form[coronary_artery_stenosis]"	  : {
                        max: 100
                    }
                }

            });

        });


    </script>
@stop


