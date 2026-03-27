@extends('enterprise.layout')
@section('title', '详情页面')

@section('content')
<div class="container-fluid">
    <div class="row" class="text-left">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <!-- <center><h2>企业详细信息</h2></center> -->
            <div class="content">
                <div class="caption">
                    <h5>{{$enterprise->name}}</h5>
                </div>
                <img src="{{$enterprise->image}}" alt="">
                <div class="caption">
                    <h6>{{$enterprise->philosophy}}</h6>
                    <p>{{$enterprise->description}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection

@section('footer')
@parent
@endsection