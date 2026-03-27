@extends('enterprise.layout')
@section('title', '首页')

@section('content')
<div class="main">
    <div class="container">
        <h3>广东十大名企</h3>
        <div class="row">
            @forelse($enterprises as $enterprise)
            <div class="col-sm-6 col-md-4  grids">
                <div class="thumbnail main-thumb">
                    <h4>{{$enterprise->abbreviate}}</h4>
                    <img src="{{asset($enterprise->image)}}" alt="">
                    <div class="caption">
                        <h5>{{$enterprise->name}}</h5>
                        <p>{{mb_substr($enterprise->description, 0, 40)}}...</p>
                        <div class="mybutton">
                            <a href="{{url('/enterprise/detail')}}/{{$enterprise->id}}" class="btn btn-default">详情</a>
                            <a class="btn btn-default" href="{{url('/enterprise/edit')}}/{{$enterprise->id}}">编辑</a>
                            <a class="btn btn-default" href="javascript:if(confirm('确定删除吗？'))window.location='/enterprise/delete/{{$enterprise->id}}'">删除</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            暂无数据
            @endforelse
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@endsection