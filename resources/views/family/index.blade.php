@extends("common.layout")

@section("title")
    家庭史
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
    家族史
@stop

@section("content-title-more")
    家族史详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">家族史</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>家族史</div>

                </div>

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="{{ url("family/create") }}" class="form-horizontal form-bordered form-label-stripped" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="Family[pid]" value="{{ $patient_info->id }}" />
                        <input type="hidden" name="Family[id_card]" value="{{ $patient_info->id_card }}" />
                        <div class="control-group">

                            <label class="control-label">姓名</label>

                            <div class="controls">

                                <input type="text" placeholder="{{ $patient_info->name }}" class="m-wrap span12" disabled />

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">父亲</label>

                            <div class="controls">

                                <div class="select2-wrapper">

                                    <input type="hidden" class="span12 select2_sample3" name="Family[father]" value="{{ $family->father }}">

                                </div>

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">母亲</label>

                            <div class="controls">

                                <div class="select2-wrapper">

                                    <input type="hidden" class="span12 select2_sample3" name="Family[mother]" value="{{ $family->mother }}">

                                </div>

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">兄弟</label>

                            <div class="controls">

                                <div class="select2-wrapper">

                                    <input type="hidden" class="span12 select2_sample3" name="Family[brother]" value="{{ $family->brother }}">

                                </div>

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">姐妹</label>

                            <div class="controls">

                                <div class="select2-wrapper">

                                    <input type="hidden" class="span12 select2_sample3" name="Family[sisters]" value="{{ $family->sisters }}">

                                </div>

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label">儿子</label>

                            <div class="controls">

                                <div class="select2-wrapper">

                                    <input type="hidden" class="span12 select2_sample3" name="Family[son]" value="{{ $family->son }}">

                                </div>

                            </div>

                        </div>

                        <div class="control-group last">

                            <label class="control-label">女儿</label>

                            <div class="controls">

                                <div class="select2-wrapper">

                                    <input type="hidden" class="span12 select2_sample3" name="Family[daughter]" value="{{ $family->daughter }}">

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
                id:".select2_sample3",
                url: "{{ url("/family/option/DISEASE") }}"

            });

        });

    </script>
@stop


