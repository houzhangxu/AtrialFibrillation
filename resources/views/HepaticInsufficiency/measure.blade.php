@extends("common.layout")

@section("title")
    肝功能不全
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
    肝功能不全
@stop

@section("content-title-more")
    肝功能不全详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="{{ url("") }}">肝功能不全</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>肝功能不全</div>

                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    <div class="form-horizontal form-view">

                        @foreach($measures as $measur)
                            <h3 class="form-section"> {{ date("Y-m-d H:i",$measur["measure_time"]) }} <a href="javascript:editRecord('{{ $measur->id }}');">修改</a> <a href="javascript:del('{{ $measur->id }}');">删除</a></h3>

                            <div class="row-fluid">

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">总蛋白g/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["total_protein"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <!--/span-->

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">白蛋白g/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["albumin"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <!--/span-->
                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">球蛋白g/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["globulin"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">白球蛋白比例: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["globulin_proportion"] }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">谷丙转氨酶U/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["glutamic_pyruvic_transaminase"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">谷草转氨酶U/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["aspartate_transaminase"] }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">总胆红素μmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["total_bilirubin"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">直接胆红素μmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["bilirubin_direct"] }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">间接胆红素μmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["indirect_bilirubin"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="lastName">护肝药: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur->option($measur["hepatinica"],"HEPATINICA") }}</span>

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
                    url: "{{ url("HepaticInsufficiency/measure/create?uid=".Request::input("uid")."&id_card=".Request::input("id_card")) }}",
                    title: "肝功能不全",
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
                url: "{{ url("HepaticInsufficiency/measure/update") }}" + "/" + id,
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
                "url": "{{ url("HepaticInsufficiency/measure/delete") }}",
                "Table": false
            });
        }
    </script>
@stop