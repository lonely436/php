<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function hello()
    {
        echo "我是来自控制器的hello方法的输出";
    }

    // add的方法就是现实add页面（resources/views/test/add.blade.php）
    public function add()
    {
        return view('test.add'); // 会从resources/views开始找，TestController对应的页面必须放在对应的test文件夹
    }

    // insert方法，就是要得到add页面传来的数据，然后对数据做处理
    public function insert(Request $request)
    {
        dump($request->all());
    }
}
