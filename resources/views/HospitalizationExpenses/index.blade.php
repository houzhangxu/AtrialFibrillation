@extends("common.layout")

@section("title")
    住院费用
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
    住院费用
@stop

@section("content-title-more")
    住院费用详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">住院费用</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>住院费用</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("HospitalizationExpenses/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
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

                            <label class="control-label">住院费用</label>

                            <div class="controls">
                                    <input type="text" class="m-wrap span12" name="Form[cost]" value="{{ isset($form->cost) ?$form->cost:"" }}" placeholder="住院费用">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">医保金额</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[medical_insurance_amount]" value="{{ isset($form->medical_insurance_amount) ?$form->medical_insurance_amount:"" }}" placeholder="医保金额">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">自负金额</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[self_amount]" value="{{ isset($form->self_amount) ?$form->self_amount:"" }}" placeholder="自负金额">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">西药费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[western_medicine_fee]" value="{{ isset($form->western_medicine_fee) ?$form->western_medicine_fee:"" }}" placeholder="西药费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">治疗费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[treatment_fee]" value="{{ isset($form->treatment_fee) ?$form->treatment_fee:"" }}" placeholder="治疗费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">材料费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[material_cost]" value="{{ isset($form->material_cost) ?$form->material_cost:"" }}" placeholder="材料费">
                            </div>

                        </div>
                        <div class="control-group">

                            <label class="control-label">护理费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[nursing_fee]" value="{{ isset($form->nursing_fee) ?$form->nursing_fee:"" }}" placeholder="护理费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">特护费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[special_fee]" value="{{ isset($form->special_fee) ?$form->special_fee:"" }}" placeholder="特护费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">化验费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[laboratory_fee]" value="{{ isset($form->laboratory_fee) ?$form->laboratory_fee:"" }}" placeholder="化验费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">化验材料</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[laboratory_material]" value="{{ isset($form->laboratory_material) ?$form->laboratory_material:"" }}" placeholder="化验材料">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">检查费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[inspection_fee]" value="{{ isset($form->inspection_fee) ?$form->inspection_fee:"" }}" placeholder="检查费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">检查材料费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[check_material_cost]" value="{{ isset($form->check_material_cost) ?$form->check_material_cost:"" }}" placeholder="检查材料费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">床位费</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[bed_fee]" value="{{ isset($form->bed_fee) ?$form->bed_fee:"" }}" placeholder="床位费">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">住院时间</label>

                            <div class="controls">
                                <input type="text" class="m-wrap span12" name="Form[hospital_stay]" value="{{ isset($form->hospital_stay) ?$form->hospital_stay:"" }}" placeholder="住院时间">
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否医保</label>

                            <div class="controls">
                                @foreach($form->option(-1,"MEDICAL_INSURANCE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[medical_insurance]" value="{{ $key }}" {{ $form["medical_insurance"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">哪里医保</label>

                            <div class="controls">
                                <input type="text" name="Form[medical_insurance_where]" value="{{ isset($form->medical_insurance_where) ?$form->medical_insurance_where:"" }}"
                                       class="span12" placeholder="哪里医保" />
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


