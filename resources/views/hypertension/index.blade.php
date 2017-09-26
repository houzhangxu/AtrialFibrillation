@extends("common.layout")

@section("title")
    账户信息
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

                    <div class="caption"><i class="icon-edit"></i>抽烟喝酒</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("sd/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
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

                            <label class="control-label">喝酒史</label>

                            <div class="controls">
                                @foreach($form->option(-1,"DRINK") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[drink]" value="{{ $key }}" {{ $form["drink"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">喝酒品种</label>

                            <div class="controls">
                                <div class="select2-wrapper">

                                    <input type="hidden" id="drink_type" class="span12 select2_sample3" name="Form[drink_type]" value="{{ $form->drink_type }}">

                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">每天的量:</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" name="Form[ml]" value="{{ isset($form->ml) ?$form->ml:0 }}" class="m-wrap span12" placeholder="每天的量" />
                                    <span class="add-on">ml</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">喝酒年数</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" name="Form[drink_year]" value="{{ isset($form->drink_year) ?$form->drink_year:0 }}" class="m-wrap span12" placeholder="喝酒年数" />
                                    <span class="add-on">年</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否戒酒</label>

                            <div class="controls">
                                @foreach($form->option(-1,"DRINK_QUIT") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[quit_drink]" value="{{ $key }}" {{ $form["quit_drink"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">戒酒年数</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" class="m-wrap span12" name="Form[quit_drink_year]" value="{{ isset($form->quit_drink_year) ?$form->quit_drink_year:0 }}" placeholder="戒酒年数">
                                    <span class="add-on">年</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">抽烟史</label>

                            <div class="controls">
                                @foreach($form->option(-1,"SMOKE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[smoke]" value="{{ $key }}" {{ $form["smoke"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">每天多少支</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" class="m-wrap span12" name="Form[somke_few]" value="{{ isset($form->somke_few) ?$form->somke_few:0 }}" placeholder="每天多少支">
                                    <span class="add-on">支</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">抽了几年</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" class="m-wrap span12" name="Form[smoke_year]" value="{{ isset($form->smoke_year) ?$form->smoke_year:0 }}" placeholder="抽了几年">
                                    <span class="add-on">年</span>
                                </div>
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否戒烟</label>

                            <div class="controls">
                                @foreach($form->option(-1,"SMOKE_QUIT") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[quit_smoke]" value="{{ $key }}" {{ $form["quit_smoke"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">戒了几年</label>

                            <div class="controls">
                                <div class="input-append">
                                    <input type="text" class="m-wrap span12" name="Form[quit_smoke_year]" value="{{ isset($form->quit_smoke_year) ?$form->quit_smoke_year:0 }}" placeholder="戒了几年">
                                    <span class="add-on">年</span>
                                </div>
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
            Hmodal.select2({
                id:"#drink_type",
                url:"{{ url("/sd/option/DRINK_TYPE") }}",

            });

            var oForm = Hmodal.form({
                id: "#oForm",
                messages: {
                    "Form[drink]": {
                        required: '喝酒史不能为空'
                    },
                    "Form[smoke]": {
                        required: '吸烟史不能为空'
                    }
                },
                rules: {
                    "Form[drink]"	  : {
                        required: true
                    },
                    "Form[smoke]"	  : {
                        required: true
                    }
                }

            });
        });


    </script>
@stop


