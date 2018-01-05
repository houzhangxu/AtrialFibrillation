@extends("admin.common.layout")

@section("title")
    模块管理
@stop

@section("header")
    @parent
@stop

@section("style")
    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/bootstrap-tree.css") }}" />
@stop

@section("sidebar")
    @parent
@stop

@section("patient-name")

@stop

@section("content-title")
    模块管理
@stop

@section("content-title-more")
    模块管理
@stop

@section("breadcrumb-li")
    <li>
        <i class="icon-angle-right"></i>
        <a href="{{ url("") }}">模块管理</a>
    </li>
@stop

@section("content")
    <div class="row-fluid">

        <div class="span4">

            <div class="portlet box grey">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-comments"></i>菜单</div>

                </div>

                <div class="portlet-body fuelux">

                    <ul class="tree" id="tree_1">

                        <li>

                            <a href="{{ url("admin/model/tree") }}" data-role="branch" data-itemid="0" class="tree-toggle closed" data-toggle="branch" data-value="menu">

                                菜单

                            </a>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="span8">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-edit"></i>模块管理</div>

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
    {{--<script src="http://jonmiles.github.io/bootstrap-treeview/js/bootstrap-treeview.js"></script>--}}
    <script src="{{ asset("media/js/bootstrap-tree.js") }}"></script>
    <script src="{{ asset("media/js/ui-tree.js") }}"></script>

    <script>
        var oTable;
        var currentNode = 0;
        jQuery(document).ready(function() {

            //App.init();
            //TableEditable.init();
            UITree.init();

            oTable = $('#data-tables').dataTable({
                "sAjaxSource": "{{ url("admin/model/record") }}",       //请求地址
                "sServerMethod":"GET",
                "aLengthMenu": [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100] // change per page values here
                ],
                "aoColumns":[
                    { "mData": "id","sTitle": "id",  "sDefaultContent": "无", "bSortable": true},
                    { "mData": "name","sTitle": "名称",  "sDefaultContent": "无", "bSortable": true},
                    { "mData": "route","sTitle": "路由",  "sDefaultContent": "无", "bSortable": true},
                    { "mData": "created_at","sTitle": "创建时间",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            return data == 0 || data == null || typeof(data) == "undefined" ? "无" : date("Y-m-d",data);
                        }
                    },
                    { "mData": "updated_at","sTitle": "更新时间",  "sDefaultContent": "无", "bSortable": true,
                        "mRender": function(data, type, full){
                            return data == 0 || data == null || typeof(data) == "undefined" ? "无" : date("Y-m-d",data);
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
                    url: "{{ url("admin/model/create") }}" + "/" + currentNode,
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

            /*
            $('#tree_1').treeview({
                data: getTree(),
                backColor: "#FFFFFF"
            });     //树
*/
            $("#tree_1").on("openbranch.tree", "[data-toggle=branch]", function (e) {   //打开主分支
                refreshDataTable(e);
            });

            $("#tree_1").on("closebranch.tree", "[data-toggle=branch]", function (e) {  //关闭主分支
                refreshDataTable(e);
            });


        });

        function editRecord(id){
            Hmodal.dialog({
                url: "{{ url("admin/model/update") }}" + "/" + id,
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

        function refreshDataTable(e){
            var nodeID = e.node.itemid;
            currentNode = nodeID;
            var oSettings = oTable.fnSettings();
            oSettings.sAjaxSource = "{{ url("admin/model/record") }}" + "/" + nodeID;
            oTable.fnDraw();
        }

        function del(id){
            Hmodal.delete({
                "id":id,
                "url": "{{ url("admin/model/delete") }}",
                "Table": oTable
            });
        }

        function detailRecord(id){
            Hmodal.dialog({
                url: "{{ url("admin/model/detail") }}" + "/" + id,
                title: "权限详情",
                width: 800,
                buttons: [
                    { inner: "关 闭", className: "btn default", click: function() { this.modal('hide'); } }
                ]
            });
        }
        
        function getTree() {    //测试树
            var data = [{
                text: "Node 1",
                icon: "tree-toggle",
                selectedIcon: "tree-toggle",
                state: {
                    checked: true,
                    expanded: true,
                    selected: true
                },
                nodes: [
                    {
                        text: "Child 1",
                        state: {
                            checked: true,
                            expanded: true,
                            selected: true
                        },
                        nodes: [
                            {
                                text: "Grandchild 1"
                            },
                            {
                                text: "Grandchild 2"
                            }
                        ]
                    },
                    {
                        text: "Child 2"
                    }
                ]
            },{
                text: "Node 2"
            }
            ];
            return data;
        }



    </script>
@stop


