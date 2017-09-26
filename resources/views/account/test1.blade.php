@extends("public.layout_test")

@section("title")
    哈哈
@stop

@section("header")
    @parent
    header
@stop

@section("sidebar")
    sidebar
@stop

@section("content")
    Content
    <!-- 1.输出变量 -->
    <p>输出变量: {{$username}}</p>

    <!-- 2.使用方法 -->
    <p>时间戳: {{time()}}</p>
    <p>时间戳转时间: {{date("Y-m-d H:i:s",time())}}</p>

    <p>in_array方法:{{in_array($username,$arr) ? "true" : "false" }}</p>
    <p>{{dump($arr)}}</p>

    <p>isset: {{  isset($username) ? $username : "default" }}</p>
    <p>or: {{ $username1 or "default" }}</p>

    <!-- 3.原样输出 -->
    <p>原样输出: @{{$username}}</p>

    <!-- 4.include 引用视图 -->
    引用视图:
    @include("account.common",[
        "message"=>"错误XXX."
    ])


    if:
    @if($username == "hou")
        <p>I am {{ $username }}</p>
    @elseif($username == "zhang")
        <p>I am zhang sir.</p>
    @else
        <p>Who is me?</p>
    @endif

    {{-- unless对于结果的取反 --}}
    unless:
    @unless($username == "hou")
        <p>I am not hou.</p>
    @else
        <p>I am unless.</p>
    @endunless

    for:
    <p>
    @for($i = 0;$i < 10;$i++)
        {{ $i }}
    @endfor
    </p>

    foreach:
    <p>
    @foreach($accounts as $account)
        {{ $account->username }},
    @endforeach
    </p>

    forelse:
    <p>
    @forelse($accounts1 as $account)
        {{ $account->username }},
    @empty
        Not data.
    @endforelse
    </p>

    URL:
    <br />
    根据路由地址生成URL链接: <a href="{{ url("account/url") }}">url()</a>
    <br />
    根据控制器生成URL链接: <a href="{{ action("AccountController@urlTest") }}">action()</a>
    <br />
    根据路由别名生成URL链接: <a href="{{ route("url") }}">route()</a>
@stop
