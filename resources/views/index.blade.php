@extends("common.layout")

@section("title")
    主页
@stop

@section("header")
    @parent
@stop

@section("style")
    <!-- BEGIN PAGE LEVEL STYLES -->

    <link rel="" type="text/css" href=http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset("media/css/DT_bootstrap.css") }}" />

    <!-- END PAGE LEVEL STYLES -->

    <style>
        .table-button{
            width: 50px;
            margin-right: 5px;
            border-radius: 5px;
        }

    </style>
@stop

@section("body-class") page-sidebar-hide @stop

@section("sidebar")
    @parent
@stop

@section("content-title")
    主页
@stop

@section("content-title-more")
    主页信息详细页面
@stop

@section("breadcrumb-li")

@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>病人列表</div>

                </div>

                <div class="portlet-body">

                    <div class="clearfix">

                        <div class="btn-group">
                            @if(auth()->user()->can('新增病人') || auth()->user()->can('普通权限'))
                                <a href="javascript:;" id="btnAdd" class="btn green btn-sm table-button">
                                    <i class="icon-plus icon-white"></i> 添加 </a>
                            @endif
                            @if(auth()->user()->can('导入') || auth()->user()->can('普通权限'))
                                    <a href="{{ url("/import") }}" id="" class="btn blue btn-sm table-button" target="_blank">
                                        <i class="icon-white icon-arrow-up"></i> 导入 </a>
                            @endif
                            @if(auth()->user()->can('导出') || auth()->user()->can('普通权限'))
                                    <a href="{{ url("/export") }}" id="" class="btn blue btn-sm table-button purple" target="_blank">
                                        <i class="icon-white icon-arrow-down"></i> 导出 </a>
                            @endif
                        </div>
                    </div>

                    <table class="table table-striped table-hover table-bordered" id="data-tables" style="width: 100%">
                    </table>

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
        var oTable;
        jQuery(document).ready(function() {

            //App.init();
            //TableEditable.init();
            $sortCols = ["name","id_card","hospital_number","connection_info1","admission_time"];
            oTable = $('#data-tables').dataTable({
                "sAjaxSource": "{{ url("patient/record.data") }}",       //请求地址
                "sServerMethod":"GET",
                "aLengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100] // change per page values here
                ],
                "aoColumns":[
                    { "mData": "name","sTitle": "姓名",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            //alert(type);
                            @if(auth()->user()->can('病人信息二级页面') || auth()->user()->can('普通权限'))
                                return '<a href="{{ url("/family") }}?uid='+full.id+'&id_card='+full.id_card+'">'+data+'</a>';
                            @else
                                return data;
                            @endif
                        }
                    },
                    { "mData": "id_card","sTitle": "身份证",  "sDefaultContent": "无", "bSortable": true },
                    { "mData": "hospital_number","sTitle": "住院号",  "sDefaultContent": "无", "bSortable": true },
                    { "mData": "phone1","sTitle": "联系方式1",  "sDefaultContent": "无", "bSortable": true },
                    { "mData": "admission_time","sTitle": "入组时间",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            //alert(type);
                            return data == 0 || data == null || typeof(data) == "undefined" ? "无" : date("Y-m-d",data);
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
                            var htmlCode = "";

                            @if(auth()->user()->can('浏览病人详细信息') || auth()->user()->can('普通权限'))
                                htmlCode += "<a href=\"javascript:void(0)\" "
                                + "onclick=\"detailRecord('" +full.id + "');\"><i class='fa fa-info'></i> 详情</a>";
                            @endif

                            @if(auth()->user()->can('修改病人') || auth()->user()->can('普通权限'))
                                htmlCode += " <a href=\"javascript:void(0)\" "
                                + "onclick=\"editRecord('" + full.id + "');\"><i class='fa fa-pencil'></i> 编辑</a>";
                            @endif

                            @if(auth()->user()->can('删除病人') || auth()->user()->can('普通权限'))
                                htmlCode += " <a href=\"javascript:void(0)\" "
                                + "onclick=\"del('" + full.id + "');\"><i class='fa fa-pencil'></i> 删除</a>";
                            @endif

                            return htmlCode;
                        }
                    }
                ],
                // set the initial value
                "iDisplayLength": 10,
                "bAutoWidth":true,  //表格宽度自适应
                "bServerSide":true, //开启服务器请求模式
                "bSort" : true, //是否启动各个字段的排序功能
                "bProcessing" : true, //DataTables载入数据时，是否显示‘进度’提示
                "bStateSave" : true, //是否打开客户端状态记录功能,此功能在ajax刷新纪录的时候不会将个性化设定回复为初始化状态
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
                    url: "{{ url("patient/create") }}",
                    title: "病人信息添加",
                    width: 800,
                    buttons: [
                        { inner: "保存", className: "btn blue",    click: function() {
                            oForm_add.submit();
                            //oTable.fnDraw();
                        } },
                        { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                    ]
                });

            });

        });

        function del(id){
            Hmodal.delete({
                "id":id,
                "url": "{{ url("patient/delete") }}",
                "Table": oTable
            });
        }

        function editRecord(id){
            Hmodal.dialog({
                url: "{{ url("patient/update") }}" + "/" + id,
                title: "修改病人信息",
                width: 800,
                buttons: [
                    { inner: "保存", className: "btn blue",click: function() {
                        oForm_update.submit();
                        //oTable.fnDraw();
                    } },
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }

        function detailRecord(id){
            Hmodal.dialog({
                url: "{{ url("patient/detail") }}" + "/" + id,
                title: "病人详情",
                width: 800,
                buttons: [
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }

    </script>
@stop

