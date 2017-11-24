<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>房颤数据-@yield("title")</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <meta name="_token" content="{{ csrf_token() }}"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="{{ asset("media/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/bootstrap-responsive.min.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/style-metro.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/style.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/style-responsive.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/default.css") }}" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="{{ asset("media/css/uniform.default.css") }}" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->

    <link href="{{ asset("media/css/jquery.gritter.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/daterangepicker.css") }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("media/css/fullcalendar.css") }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("media/css/jqvmap.css") }}" rel="stylesheet" type="text/css" media="screen"/>

    <link href="{{ asset("media/css/jquery.easy-pie-chart.css") }}" rel="stylesheet" type="text/css" media="screen"/>

    <!-- END PAGE LEVEL STYLES -->

    <!-- 模态框开始 -->
    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/jquery-ui-1.10.1.custom.min.css") }}" />

    <link href="{{ asset("media/css/bootstrap-modal.css") }}" rel="stylesheet" type="text/css"/>
    <!-- 模态框结束 -->

    <!-- toastr提示框样式开始 -->
    <link rel="stylesheet" href="{{ asset("media/css/toastr.css") }}" type="text/css" />
    <!-- toastr提示框样式结束 -->

    <!-- 时间日期控件开始 -->
    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/datepicker.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/timepicker.css") }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/datetimepicker.css") }}" />
    <!-- 时间日期控件结束 -->

    <!-- select2开始 -->
    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/select2_metro.css") }}" />
    <!-- select2开始 -->

    <!-- 自有css开始 -->
    <link rel="stylesheet" type="text/css" href="{{ asset("media/css/h.css") }}" />
    <!-- 自有css结束 -->

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

        .select2-drop {
            z-index: 10050 !important;
        }

        .select2-search-choice-close {
            margin-top: 0 !important;
            right: 2px !important;
            min-height: 10px;
        }

        .select2-search-choice-close:before {
            color: black !important;
        }
        /*防止select2不会自动失去焦点*/
        .select2-container {
            z-index: 16000 !important;
        }

        .select2-drop-mask {
            z-index: 15990 !important;
        }

        .select2-drop-active {
            z-index: 15995 !important;
        }

    </style>

    @section("style")

    @show

    <link rel="shortcut icon" href="{{ asset("media/image/favicon.ico") }}" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed @yield("body-class")">

<!-- BEGIN HEADER -->

@section("header")
    <div class="header navbar navbar-inverse navbar-fixed-top">

        <!-- BEGIN TOP NAVIGATION BAR -->

        <div class="navbar-inner">

            <div class="container-fluid">

                <!-- BEGIN LOGO -->

                <a class="brand" href="{{ url("/") }}">

                    <img src="{{ asset("media/image/logo.png") }}" alt="logo"/>

                </a>

                <!-- END LOGO -->

                <!-- BEGIN RESPONSIVE MENU TOGGLER -->

                <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

                    <img src="{{ asset("media/image/menu-toggler.png") }}" alt="" />

                </a>

                <!-- END RESPONSIVE MENU TOGGLER -->

                <!-- BEGIN TOP NAVIGATION MENU -->

                <ul class="nav pull-right">

                    <!-- BEGIN USER LOGIN DROPDOWN -->

                    <li class="dropdown user">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <img alt="" src="{{ asset("media/image/avatar_qq.jpg") }}" width="29" height="29" />

                            <span class="username"> {{ Auth::user()->name }}</span>

                            <i class="icon-angle-down"></i>

                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-key"></i> Log Out</a></li>
                        </ul>

                    </li>

                    <!-- END USER LOGIN DROPDOWN -->

                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <!-- END TOP NAVIGATION MENU -->

            </div>

        </div>

        <!-- END TOP NAVIGATION BAR -->

    </div>
@show

<!-- END HEADER -->

<!-- BEGIN CONTAINER -->

<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    @section("sidebar")
        <div class="page-sidebar nav-collapse collapse">

            <!-- BEGIN SIDEBAR MENU -->

            <ul class="page-sidebar-menu">

                <li>

                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                    <div class="sidebar-toggler hidden-phone"></div>

                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                </li>
                <li>
                    <div style="margin-top:5px;"></div>
                </li>

                <li class="{{ !strstr(Request::getPathInfo(),"measure") ? "active" : "" }}">
                    <a href="javascript:;">

                        <i class="icon-file-text"></i>

                        <span class="title">系统管理</span>

                        <span class="arrow"></span>

                    </a>

                    <ul class="sub-menu">
                        <li class="{{ Request::getPathInfo() == "/admin/user" ?"active" : "" }}">
                            <a href="{{ route("admin.user.index") }}">用户管理</a>
                        </li>
                        <li class="{{ Request::getPathInfo() == "/admin/role" ?"active" : "" }}">
                            <a href="{{ route("admin.role.index") }}">角色管理</a>
                        </li>
                        <li class="{{ Request::getPathInfo() == "/admin/permissions" ?"active" : "" }}">
                            <a href="{{ route("admin.permissions.index") }}">权限管理</a>
                        </li>
                    </ul>

                </li>

            </ul>

            <!-- END SIDEBAR MENU -->

        </div>
@show

<!-- END SIDEBAR -->

    <!-- BEGIN PAGE -->

    <div class="page-content">

        <!-- BEGIN PAGE CONTAINER-->

        <div class="container-fluid">

            <!-- BEGIN PAGE HEADER-->
            @section("content-header")
                <div class="row-fluid">

                    <div class="span12">

                        <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                        <h3 class="page-title">

                            @yield("content-title") <small>@yield("content-title-more")</small>

                        </h3>

                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ route("/") }}">主页</a>
                            </li>
                            @yield("breadcrumb-li")
                        </ul>

                        <!-- END PAGE TITLE & BREADCRUMB-->

                    </div>

                </div>
            @show
        <!-- END PAGE HEADER-->
            @yield("content")

        </div>

        <!-- END PAGE CONTAINER-->

    </div>

    <!-- END PAGE -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
@section("footer")
    <div class="footer">

        <div class="footer-inner">

            2017 &copy; 房颤数据 <a href="http://123.206.199.205" title="PA" target="_blank">Position:Absolute</a>

        </div>

        <div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

        </div>

    </div>
@show

<div id="ajax-modal" class="modal hide fade" data-width="800" tabindex="-1">

    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h3>Responsive</h3>

    </div>

    <div class="modal-body">


    </div>

    <div class="modal-footer">

        <button type="button" data-dismiss="modal" class="btn">Close</button>

        <button type="button" class="btn blue">Save changes</button>

    </div>

</div>
<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="{{ asset("media/js/jquery-1.10.1.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery-migrate-1.2.1.min.js") }}" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="{{ asset("media/js/jquery-ui-1.10.1.custom.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/bootstrap.min.js") }}" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="{{ asset("media/js/excanvas.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("media/js/respond.min.js") }}" type="text/javascript"></script>

<![endif]-->

<script src="{{ asset("media/js/jquery.slimscroll.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.blockui.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.cookie.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.uniform.min.js") }}" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="{{ asset("media/js/jquery.vmap.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.vmap.russia.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.vmap.world.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.vmap.europe.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.vmap.germany.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.vmap.usa.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.vmap.sampledata.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.flot.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.flot.resize.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.pulsate.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/date.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/daterangepicker.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.gritter.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/fullcalendar.min.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.easy-pie-chart.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/jquery.sparkline.min.js") }}" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="{{ asset("media/js/app.js") }}" type="text/javascript"></script>

<script src="{{ asset("media/js/index.js") }}" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<!-- 数据表格开始 -->

<script type="text/javascript" src="{{ asset("media/js/select2.min.js") }}"></script>

<script type="text/javascript" src="{{ asset("media/js/jquery.dataTablesv1.min.js") }}"></script>

<script type="text/javascript" src="{{ asset("media/js/DT_bootstrap.js") }}"></script>

<script src="{{ asset("media/js/table-editable.js") }}"></script>

<!-- 数据表格结束 -->

<!-- 模态框开始 -->

<script src="{{ asset("media/js/bootstrap-modal.js") }}" type="text/javascript" ></script>

<script src="{{ asset("media/js/bootstrap-modalmanager.js") }}" type="text/javascript" ></script>

<script src="{{ asset("media/js/ui-modals.js") }}"></script>

<script src="{{ asset("media/js/hou-modal.js") }}"></script>

<!-- 模态框结束 -->

<!-- 表单验证开始 -->
<script type="text/javascript" src="{{ asset("media/js/jquery.validate.min.js") }}"></script>
<script src="{{ asset("media/js/form-validation.js") }}"></script>
<!-- 表单验证结束-->

<!-- toastr提示框开始 -->
<script src="{{ asset("media/js/toastr.min.js") }}"></script>
<!-- toastr提示框结束 -->

<!-- 时间控件开始 -->
<script type="text/javascript" src="{{ asset("media/js/bootstrap-datepicker.js") }}"></script>
<script type="text/javascript" src="{{ asset("media/js/bootstrap-datetimepicker.min.js") }}"></script>
<!-- 时间控件结束 -->

<!-- 公用JS方法开始 -->
<script src="{{ asset("media/js/HTool.js") }}"></script>
<!-- 公用JS方法结束 -->

<script>

    jQuery(document).ready(function() {

        App.init(); // initlayout and core plugins

        @yield("document-ready")

        //        Index.init();

//        Index.initJQVMAP(); // init index page's custom scripts

//        Index.initCalendar(); // init index page's custom scripts

//        Index.initCharts(); // init index page's custom scripts

//        Index.initChat();

//        Index.initMiniCharts();

//        Index.initDashboardDaterange();

//        Index.initIntro();

        @include("common.result_state")

    });

</script>



@yield("footer-script")

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>