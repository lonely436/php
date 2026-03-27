@extends('enterprise.layout')
@section('title', '编辑企业')

@section('content')
<div class="container-fluid">
    <div class="row" class="text-left">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <center>
                <h3>编辑企业信息</h3>
            </center>

            <form action="{{url('/enterprise/update')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>名 称</label>
                    <input type="text" name="name" value="{{$enterprise->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>简 称</label>
                    <input type="text" name="abbreviate" value="{{$enterprise->abbreviate}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>理 念</label>
                    <input type="text" name="philosophy" value="{{$enterprise->philosophy}}" class="form-control">
                </div>
                <div class="row" class="text-left">
                    <div class="col-md-4">
                        <div class="form-group form-inline">
                            <label for="exampleInputFile">照 片</label>
                            <input type="file" name="image" id="exampleInputFile">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <span><img class="img-thumbnail" src="{{$enterprise->image}}" width="60px" alt="头像" /></span>

                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">描 述</label>
                    <textarea name="description" class="form-control"
                        rows="3">{{$enterprise->description}}</textarea>
                </div>
                <input type="hidden" name="id" value="{{$enterprise->id}}">
                <button type="submit" class="btn btn-info">提交</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection