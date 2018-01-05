@extends("common.layout")

@section("title")
    血脂
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
    血脂
@stop

@section("content-title-more")
    血脂详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="{{ url("") }}">血脂</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>血脂</div>

                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    <div class="form-horizontal form-view">

                        @foreach($measures as $measur)
                            <h3 class="form-section"> {{ date("Y-m-d H:i",$measur["measure_time"]) }} <a href="javascript:editRecord('{{ $measur->id }}');">修改</a> <a href="javascript:del('{{ $measur->id }}');">删除</a></h3>

                            <div class="row-fluid">

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">甘油三酯mmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["triglyceride"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <!--/span-->

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">总胆固醇mmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["cholesterol_total"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <!--/span-->
                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">高密度脂蛋白-Cmmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["high_density_lipoprotein"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">低密度脂蛋白-Cmmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["low_densith_lipoprotein"] }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">极低密度脂蛋白-Cmmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["very_low_density_lipoprotein"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">他汀: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur->option($measur["statin"],"STATIN") }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">剂量mg: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["dose"] }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                        @if(!isset($measures) || $measures == null || $measures == "")
                        无
                        @endif

                        <div class="form-actions">

                            <button type="button" id="btnAdd" class="btn blue"><i class="icon-pencil"></i> 添加新记录</button>

                        </div>

                    </div>
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

            $('#btnAdd').on('click', function(){
                // create the backdrop and wait for next modal to be triggered
                Hmodal.dialog({
                    url: "{{ url("BloodFat/measure/create?id_card=".Request::input("id_card")) }}",
                    title: "血脂",
                    width: 800,
                    buttons: [
                        { inner: "保存", className: "btn blue",    click: function() {
                            oForm_add.submit();
                        } },
                        { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                    ]
                });

            });
        });

        function editRecord(id){
            Hmodal.dialog({
                url: "{{ url("BloodFat/measure/update") }}" + "/" + id,
                title: "修改数据",
                width: 800,
                buttons: [
                    { inner: "保存", className: "btn blue",click: function() {
                        oForm_update.submit();
                    } },
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }

        function del(id){
            Hmodal.delete({
                "id":id,
                "url": "{{ url("BloodFat/measure/delete") }}",
                "Table": false
            });
        }
    </script>
@stop