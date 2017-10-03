@extends("common.layout")

@section("title")
    生殖激素
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
    生殖激素
@stop

@section("content-title-more")
    生殖激素详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">生殖激素</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>生殖激素</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("ReproductiveHormone/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
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

                            <label class="control-label">睾酮ng/dl</label>

                            <div class="controls">
                                    <input type="text" class="m-wrap span12" name="Form[testosterone]" value="{{ isset($form->testosterone) ?$form->testosterone:"" }}" placeholder="睾酮ng/dl">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">雌二醇pg/ml</label>

                            <div class="controls">
                                <input type="text" name="Form[estradiol]" value="{{ isset($form->estradiol) ?$form->estradiol:"" }}"
                                           class="span12" placeholder="雌二醇pg/ml" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">卵泡刺激素mIU/mL</label>

                            <div class="controls">
                                <input type="text" name="Form[follicule_stimulating_hormone]" value="{{ isset($form->follicule_stimulating_hormone) ?$form->follicule_stimulating_hormone:"" }}"
                                       class="span12" placeholder="卵泡刺激素mIU/mL" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">黄体生成素mIU/mL</label>

                            <div class="controls">
                                <input type="text" name="Form[luteinizing_hormone]" value="{{ isset($form->luteinizing_hormone) ?$form->luteinizing_hormone:"" }}"
                                       class="span12" placeholder="黄体生成素mIU/mL" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">泌乳素ng/ml</label>

                            <div class="controls">
                                <input type="text" name="Form[prolactin]" value="{{ isset($form->prolactin) ?$form->prolactin:"" }}"
                                       class="span12" placeholder="泌乳素ng/ml" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">孕酮ng/ml</label>

                            <div class="controls">
                                <input type="text" name="Form[progesterone]" value="{{ isset($form->progesterone) ?$form->progesterone:"" }}"
                                       class="span12" placeholder="孕酮ng/ml" />
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


