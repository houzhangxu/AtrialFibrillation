<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield("title")</title>
    <style>
        *{
            margin: 0px;
            padding:0px;
        }
        html,body{
            height: 100%;
            width: 100%;
            font-size: 12px;
            color: #333;
        }
        a:hover{
            text-decoration: none;
        }
        li{
            list-style: none;
        }
        body > div{
            padding: 5px;
            box-sizing: border-box;
        }
        #header{
            width: 100%;
            height: 40px;
            background-color: #FFE4C4;
        }

        #sidebar{
            float: left;
            width: 30%;
            height: 550px;
            background-color: #FF6347;
            padding: 5px;
        }

        #content{
            float: left;
            width: 70%;
            height: 550px;
            background-color: #F59DA2;
            padding: 5px;
        }

        #footer{
            clear: both;
            width: 100%;
            height: 60px;
            background-color: #A2F549;
            padding: 5px;
        }

    </style>
</head>
<body>

    <div id="header">
        @section("header")
            我是头部
        @show
    </div>
    <div id="sidebar">
        @section("sidebar")
            我是侧边栏
        @show
    </div>
    <div id="content">
        @yield("content","我是主内容区")
    </div>
    <div id="footer">
        @section("footer")
            我是底部
        @show
    </div>

</body>
</html>