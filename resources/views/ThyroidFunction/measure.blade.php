@extends("common.layout")

@section("title")
    甲状腺功能
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
    甲状腺功能
@stop

@section("content-title-more")
    甲状腺功能详细信息
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="{{ url("") }}">甲状腺功能</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>甲状腺功能</div>

                </div>

                <div class="portlet-body form">

                    <!-- BEGIN FORM-->
                    <div class="form-horizontal form-view">

                        @foreach($measures as $measur)
                            <h3 class="form-section"> {{ date("Y-m-d H:i",$measur["measure_time"]) }} <a href="javascript:editRecord('{{ $measur->id }}');">修改</a> <a href="javascript:del('{{ $measur->id }}');">删除</a></h3>

                            <div class="row-fluid">

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">总甲状腺素nmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["thyroxine"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <!--/span-->

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">总三碘甲状腺原氨酸nmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["triiodothyronine"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <!--/span-->
                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">第三代促甲状腺素mIU/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["third_generation_thyroid_stimulating_hormone"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">游离甲状腺素: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["free_thyroxine"] }}</span>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="row-fluid">
                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">游离三碘甲状腺原氨酸pmol/L: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["free_triiodothyronine"] }}</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="span6 ">

                                    <div class="control-group">

                                        <label class="control-label" for="">甲状腺过氧化物酶抗体IU/mL: </label>

                                        <div class="controls">

                                            <span class="text">{{ $measur["thyroid_peroxidase_antibody"] }}</span>

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
                    url: "{{ url("ThyroidFunction/measure/create?uid=".Request::input("uid")."&id_card=".Request::input("id_card")) }}",
                    title: "甲状腺功能",
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
                url: "{{ url("ThyroidFunction/measure/update") }}" + "/" + id,
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
                "url": "{{ url("ThyroidFunction/measure/delete") }}",
                "Table": false
            });
        }
    </script>
@stop