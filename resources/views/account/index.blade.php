@extends("common.layout")

@section("title")
    账户信息
@stop

@section("header")
    @parent
@stop

@section("style")
    <!-- BEGIN PAGE LEVEL STYLES -->

    <link rel="stylesheet" type="text/css" href="media/css/select2_metro.css" />
    <link rel="" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="media/css/DT_bootstrap.css" />


    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="media/image/favicon.ico" />
    <style>
        .table-button{
            width: 50px;
            margin-right: 5px;
            border-radius: 5px;
        }

    </style>
@stop

@section("sidebar")
    @parent
@stop


@section("content-title")
    账户信息
@stop

@section("content-title-more")
    账户信息详细页面
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-home"></i>
        <a href="{{ route("/") }}">主页</a>
    </li>
    <li>
        <i class="icon-angle-right"></i>
        <a href="#">账户信息</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>账户</div>

                </div>

                <div class="portlet-body">

                    <div class="clearfix">

                        <div class="btn-group">
                            <a href="javascript:;" id="btnAdd" class="btn green btn-sm table-button">
                                <i class="icon-plus icon-white"></i> 添加 </a>
                            <!--
                            <a href="javascript:;" id="btnQuery" class="btn blue btn-sm table-button">
                                <i class="icon-white icon-search"></i> 查询 </a>
                                -->
                        </div>
                    </div>

                    <table class="table table-striped table-hover table-bordered" id="data-tables">
                    </table>

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
        var oTable;
        jQuery(document).ready(function() {

            //App.init();
            //TableEditable.init();

            oTable = $('#data-tables').dataTable({
                "sAjaxSource": "{{ url("account/record.data") }}",       //请求地址
                "sServerMethod":"GET",
                "aLengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100] // change per page values here
                ],
                "aoColumns":[
                    { "mData": "username","sTitle": "用户名",  "sDefaultContent": "无", "bSortable": true },
                    { "mData": "password","sTitle": "密码",  "sDefaultContent": "无", "bSortable": true },
                    { "mData": "sex","sTitle": "性别",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            //alert(type);
                            return data == 0 ? "女" : "男";
                        }
                    },
                    { "mData": "created_at","sTitle": "添加时间",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            //alert(type);
                            return date("Y-m-d H:i:s",data);
                        }
                    },
                    { "mData": "updated_at","sTitle": "修改时间",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            //alert(type);
                            return date("Y-m-d H:i:s",data);
                        }
                    },
                    {
                        "mData": "op",
                        "sTitle": "操&#12288;作",
                        "sDefaultContent": "",
                        "sClass": "center nowrap",
                        "bSortable": false,
                        "sWidth":"100px",
                        "mRender": function(data, type, full) {

                            var htmlCode = "<a href=\"javascript:void(0)\" "
                                + "onclick=\"detailRecord('" +full.id + "');\"><i class='fa fa-info'></i> 详情</a>";

                            htmlCode += " <a href=\"javascript:void(0)\" "
                                + "onclick=\"editRecord('" + full.id + "');\"><i class='fa fa-pencil'></i> 编辑</a>";
                            htmlCode += " <a href=\"javascript:void(0)\" "
                                + "onclick=\"del('" + full.id + "');\"><i class='fa fa-pencil'></i> 删除</a>";

                            return htmlCode;
                        }
                    }
                ],
                // set the initial value
                "iDisplayLength": 10,
                "bAutoWidth":true,  //表格宽度自适应
                "bServerSide":true, //开启服务器请求模式
                "bSort" : true, //是否启动各个字段的排序功能
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sProcessing": "正在加载中......",
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "正在加载中......",
                    "sEmptyTable": "查询无数据！",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",
                    "sInfoEmpty": "显示0到0条记录",
                    "sInfoFiltered": "数据表中共为 _MAX_ 条记录",
                    "sSearch": "Search: ",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                    'bSortable': true,
                    'aTargets': [0]
                }
                ],
                "order": [
                    [4, "desc"]
                ]
            });

            //var $modal = $('#ajax-modal');

            $('#btnAdd').on('click', function(){
                // create the backdrop and wait for next modal to be triggered
                Hmodal.dialog({
                    url: "{{ url("account/create") }}",
                    title: "账户添加",
                    width: 800,
                    buttons: [
                        { inner: "保存", className: "btn blue",    click: function() {
                            oForm_add.submit();
                            oTable.fnDraw();
                        } },
                        { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                    ]
                });

            });

        });
        function del(id){
            Hmodal.delete({
                id: id,
                url: "{{ url("account/del") }}",
                oTable: oTable
            });

        }
        function editRecord(id){
            Hmodal.dialog({
                url: "{{ url("account/modify") }}" + "/" + id,
                title: "账户修改",
                width: 800,
                buttons: [
                    { inner: "保存", className: "btn blue",    click: function() {
                        oForm_update.submit();
                        oTable.fnDraw();
                    } },
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }
        function detailRecord(id){
            Hmodal.dialog({
                url: "{{ url("account/detail") }}" + "/" + id,
                title: "账户详情",
                width: 800,
                buttons: [
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }

    </script>
@stop