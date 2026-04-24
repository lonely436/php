@extends('enterprise.layout')
@section('title', '增加企业')

@section('content')
<div class="container-fluid">
    <div class="row" class="text-left">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <center>
                <h3>添加企业信息</h3>
            </center>
            <form action="{{url('/enterprise/insert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>名 称</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="企业名称">
                </div>
                <div class="form-group">
                    <label>简 称</label>
                    <input type="text" name="abbreviate" value="{{old('abbreviate')}}" class="form-control" placeholder="企业简称">
                </div>
                <div class="form-group">
                    <label>理 念</label>
                    <input type="text" name="philosophy" value="{{old('philosophy')}}" class="form-control" placeholder="企业理念">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">图 片</label>
                    <input type="file" name="image" id="exampleInputFile">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">描 述</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="企业描述">{{old('description')}}</textarea>
                </div>
                <button type="submit" class="btn btn-info">提交</button>
                @include('errors.error')
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection

@section('footer')
navbar-fixed-bottom
@endsection