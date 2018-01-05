@extends("common.layout")

@section("title")
    手术参数
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
    手术参数
@stop

@section("content-title-more")
    手术参数详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">手术参数</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>手术参数</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="oForm" action="{{ url("Operation/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Form[id_card]" value="{{ $patient_info->id_card }}" />

                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">手术医生</label>

                            <div class="controls">
                                @foreach($form->option(-1,"DOCTOR") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[doctor]" value="{{ $key }}" {{ $form["doctor"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">一助</label>

                            <div class="controls">
                                @foreach($form->option(-1,"FIRST_ASSISTANT") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[first_assistant]" value="{{ $key }}" {{ $form["first_assistant"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">手术方式</label>

                            <div class="controls">
                                @foreach($form->option(-1,"OPERATION_MODE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[operation_mode]" value="{{ $key }}" {{ $form["operation_mode"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否附加线消融</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ADD_MELT") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[add_melt]" value="{{ $key }}" {{ $form["add_melt"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">手术时间</label>

                            <div class="controls">
                                <input type="text" name="Form[operation_time]" value="{{ isset($form->operation_time) ?$form->operation_time:"" }}"
                                       class="span12" placeholder="手术时间" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">传出阻滞</label>

                            <div class="controls">
                                @foreach($form->option(-1,"EFFERENT_BLOCK") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[efferent_block]" value="{{ $key }}" {{ $form["efferent_block"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">肺静脉电位消失</label>

                            <div class="controls">
                                @foreach($form->option(-1,"PULMONARY_VEIN") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[pulmonary_vein]" value="{{ $key }}" {{ $form["pulmonary_vein"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">传入阻滞</label>

                            <div class="controls">
                                @foreach($form->option(-1,"AFFERENT_BLOCK") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[afferent_block]" value="{{ $key }}" {{ $form["afferent_block"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">出血量</label>

                            <div class="controls">
                                <input type="text" name="Form[bleeding_volume]" value="{{ isset($form->bleeding_volume) ?$form->bleeding_volume:"" }}"
                                       class="span12" placeholder="出血量" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">是否电复率</label>

                            <div class="controls">
                                @foreach($form->option(-1,"ELECTRIC_REPETITION_RATE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[electric_repetition_rate]" value="{{ $key }}" {{ $form["electric_repetition_rate"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">可达龙mg</label>

                            <div class="controls">
                                <input type="text" name="Form[amiodaronum]" value="{{ isset($form->amiodaronum) ?$form->amiodaronum:"" }}"
                                       class="span12" placeholder="可达龙mg" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">心包填塞</label>

                            <div class="controls">
                                @foreach($form->option(-1,"PERICARDIAL_TAMPONADE") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[pericardial_tamponade]" value="{{ $key }}" {{ $form["pericardial_tamponade"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">肝素（U）</label>

                            <div class="controls">
                                <input type="text" name="Form[heparin]" value="{{ isset($form->heparin) ?$form->heparin:"" }}"
                                       class="span12" placeholder="肝素（U）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">芬太尼（mg）</label>

                            <div class="controls">
                                <input type="text" name="Form[fentanyl]" value="{{ isset($form->fentanyl) ?$form->fentanyl:"" }}"
                                       class="span12" placeholder="芬太尼（mg）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">术中迷走反射低血压</label>

                            <div class="controls">
                                @foreach($form->option(-1,"INTRAOPERATIVE_VAGAL_REFLEX_HYPOTENSION") as $key => $value)
                                    <label class="radio">
                                        <input type="radio" name="Form[intraoperative_vagal_reflex_hypotension]" value="{{ $key }}" {{ $form["intraoperative_vagal_reflex_hypotension"] == $key ? "checked" : "" }} />
                                        {{ $value }}
                                    </label>
                                @endforeach
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">阿托品（mg）</label>

                            <div class="controls">
                                <input type="text" name="Form[atropine]" value="{{ isset($form->atropine) ?$form->atropine:"" }}"
                                       class="span12" placeholder="阿托品（mg）" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">多巴胺(mg)</label>

                            <div class="controls">
                                <input type="text" name="Form[dopamine]" value="{{ isset($form->dopamine) ?$form->dopamine:"" }}"
                                       class="span12" placeholder="多巴胺(mg)" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">其他并发症</label>

                            <div class="controls">
                                <input type="text" name="Form[other_complications]" value="{{ isset($form->other_complications) ?$form->other_complications:"" }}"
                                       class="span12" placeholder="其他并发症" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">左房测压消融前</label>

                            <div class="controls">
                                <input type="text" name="Form[left_atrial_manometry_before_ablation]" value="{{ isset($form->left_atrial_manometry_before_ablation) ?$form->left_atrial_manometry_before_ablation:"" }}"
                                       class="span12" placeholder="左房测压消融前" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">左房测压消融后</label>

                            <div class="controls">
                                <input type="text" name="Form[left_atrial_manometry_after_ablation]" value="{{ isset($form->left_atrial_manometry_after_ablation) ?$form->left_atrial_manometry_after_ablation:"" }}"
                                       class="span12" placeholder="左房测压消融后" />
                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">左房测压房颤</label>

                            <div class="controls">
                                <input type="text" name="Form[left_atrial_manometry_atrial_fibrillation]" value="{{ isset($form->left_atrial_manometry_atrial_fibrillation) ?$form->left_atrial_manometry_atrial_fibrillation:"" }}"
                                       class="span12" placeholder="左房测压房颤" />
                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">左房测压窦性</label>

                            <div class="controls">
                                <input type="text" name="Form[left_atrial_manometry_sinus]" value="{{ isset($form->left_atrial_manometry_sinus) ?$form->left_atrial_manometry_sinus:"" }}"
                                       class="span12" placeholder="左房测压窦性" />
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


