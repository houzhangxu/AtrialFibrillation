@extends("common.layout")

@section("title")
    BNP
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
    BNP
@stop

@section("content-title-more")
    BNP详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">BNP</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>BNP</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("BNP/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Form[id_card]" value="{{ $patient_info->id_card }}" />

                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">BNPpg/Ml</label>

                            <div class="controls">
                                    <input type="text" class="m-wrap span12" name="Form[bnp]" value="{{ isset($form->bnp) ?$form->bnp:"" }}" placeholder="BNPpg/Ml">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">TNI定量（ng/mL）</label>

                            <div class="controls">
                                <input type="text" name="Form[TNI]" value="{{ isset($form->TNI) ?$form->TNI:"" }}"
                                           class="span12" placeholder="TNI定量（ng/mL）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">CK（U/L）</label>

                            <div class="controls">
                                <input type="text" name="Form[CK]" value="{{ isset($form->CK) ?$form->CK:"" }}"
                                       class="span12" placeholder="CK（U/L）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">CK-MB（U/L）</label>

                            <div class="controls">
                                <input type="text" name="Form[CK_MB]" value="{{ isset($form->CK_MB) ?$form->CK_MB:"" }}"
                                       class="span12" placeholder="CK-MB（U/L）" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">CRPmg/L</label>

                            <div class="controls">
                                <input type="text" name="Form[CRP]" value="{{ isset($form->CRP) ?$form->CRP:"" }}"
                                       class="span12" placeholder="CRPmg/L" />
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


