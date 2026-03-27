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

    // 文件上传方法
    public function upload(Request $request)
    {
        // 1、判断是否有文件上传
        if ($request->hasFile('file')) {
            // 2、创建文件上传对象
            $file = $request->file('file');
            // 3、执行上传
            $path = $file->store('images'); // 文件名自动生成，文件上传到默认位置
            dump($path);
        }
    }

    // 多文件上传方法
    public function mulupload(Request $request)
    {
        // 1、判断是否有文件上传
        if ($request->hasFile('files')) {
            // 2、创建文件上传对象
            $files = $request->file('files');
            // 3、执行上传
            $paths = [];
            foreach ($files as $file) {
                $path = $file->store('images'); // 文件名自动生成，文件上传到默认路径下的images下
                // 4、把地址写入数组
                array_push($paths, $path);
            }
            dump($paths);
        }
    }
}
