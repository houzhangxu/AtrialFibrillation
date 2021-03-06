@extends("admin.common.layout")

@section("title")
    权限管理
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

@stop

@section("content-title")
    权限管理
@stop

@section("content-title-more")
    对于权限的管理
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="{{ url("") }}">权限管理</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>权限列表</div>

                </div>

                <div class="portlet-body">

                    <div class="clearfix">

                        <div class="btn-group">
                            <a href="javascript:;" id="btnAdd" class="btn green btn-sm table-button">
                                <i class="icon-plus icon-white"></i> 添加 </a>
                        </div>
                    </div>

                    <table class="table table-striped table-hover table-bordered dataTable" id="data-tables" style="width: 100%">
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

            oTable = $('#data-tables').dataTable({
                "sAjaxSource": "{{ url("admin/permissions/record.data") }}",       //请求地址
                "sServerMethod":"GET",
                "aLengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100] // change per page values here
                ],
                "aoColumns":[
                    { "mData": "id","sTitle": "id",  "sDefaultContent": "无", "bSortable": true},
                    { "mData": "name","sTitle": "权限名称",  "sDefaultContent": "无", "bSortable": true},
                    { "mData": "created_at","sTitle": "创建时间",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            //return data == 0 || data == null || typeof(data) == "undefined" ? "无" : date("Y-m-d",data);
                            return data;
                        }
                    },
                    {
                        "mData": "op",
                        "sTitle": "操&#12288;作",
                        "sWidth":"105px",
                        "sDefaultContent": "",
                        "sClass": "center nowrap",
                        "bSortable": false,
                        "mRender": function(data, type, full) {

                            var htmlCode = "<a href=\"javascript:void(0)\" "
                                + "onclick=\"detailRecord('" +full.id + "');\"><i class='fa fa-info'></i> <span class=\"label label-success\">详情</a></a>";
                            htmlCode += " <a href=\"javascript:void(0)\" "
                                + "onclick=\"editRecord('" + full.id + "');\"><i class='fa fa-pencil'></i> <span class=\"label label-info\">编辑</span></a>";
                            htmlCode += " <a href=\"javascript:void(0)\" "
                                + "onclick=\"del('" + full.id + "');\"><i class='fa fa-pencil'></i> <span class=\"label label-warning\">删除</span></a>";
                            return htmlCode;
                        }
                    }
                ],
                // set the initial value
                "iDisplayLength": 10,
                "bAutoWidth":true,  //表格宽度自适应
                "bServerSide":true, //开启服务器请求模式
                "bSort" : true, //是否启动各个字段的排序功能
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
                    [0, "desc"]
                ]
            });

            //var $modal = $('#ajax-modal');

            $('#btnAdd').on('click', function(){
                // create the backdrop and wait for next modal to be triggered
                Hmodal.dialog({
                    url: "{{ url("admin/permissions/create") }}",
                    title: "权限添加",
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

        function editRecord(id){
            Hmodal.dialog({
                url: "{{ url("admin/permissions/update") }}" + "/" + id,
                title: "修改权限",
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

        function del(id){
            Hmodal.delete({
                "id":id,
                "url": "{{ url("admin/permissions/delete") }}",
                "Table": oTable
            });
        }

        function detailRecord(id){
            Hmodal.dialog({
                url: "{{ url("admin/permissions/detail") }}" + "/" + id,
                title: "权限详情",
                width: 800,
                buttons: [
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }

    </script>
@stop


