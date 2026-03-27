<!DOCTYPE html>
<html>
<!-- 头部 -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>广东名企--@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <!-- 导航条 -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand " href="#">奋进广东&科技自立自强</a> -->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><img class="logo" src="{{asset('images/mylogo.png')}}" alt=""></li>
                    <li><a href="#"> <span class="sr-only">(current)</span></a></li>
                    <li><a href="{{url('/enterprise/index')}}">首页</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">名企管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/enterprise/add')}}">添加企业</a></li>
                            <li><a href="{{url('/enterprise/index')}}">管理企业</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">欢迎您：admin</a></li>
                    <li><a href="#">退出登录</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <!-- 页面主体内容 -->
    <div class="main">
        @yield('content')
    </div>

    <!-- 页脚 -->
    <nav class="navbar @section('footer') navbar-default  @show myfooter">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9"
            style="text-align:center;color:gray;height:50px;line-height:50px;">
            @copyright zspt-Laravel 2023-2030
        </div>
    </nav>

    <!-- 尾部 -->
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>

</html>