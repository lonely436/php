<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Enterprise;

class EnterpriseController extends Controller
{
    public function index()
    {
        // 1、从数据库中获取数据
        $enterprises = DB::table('enterprise')->get();
        // 2、把数据给到页面显示
        return view('enterprise.index', ['enterprises' => $enterprises]);
    }

    public function add()
    {
        return view('enterprise.add');
    }

    public function insert(Request $request)
    {
        if (strlen($request->input('name')) >= 2 && $request->hasFile('image')) {
            // 上传图片
            $file = $request->file('image');
            $path = $file->store('images');
            $pashDB = "/uploads/" . $path; // 写入数据库的路径

            // 插入
            DB::table('enterprise')->insert(
                [
                    'name' => $request->input('name'),
                    'abbreviate' => $request->input('abbreviate'),
                    'philosophy' => $request->input('philosophy'),
                    'image' => $pashDB,
                    'description' => $request->input('description'),
                ]
            );
            // 插入完毕后，回到首页验证
            return redirect('/enterprise/index');
        } else {
            // 缓存信息
            $request->flash();
            return back();
        }
    }

    public function delete($id)
    {
        // 1、从数据库找到企业
        $result = DB::table('enterprise')->where('id', $id)->delete();
        // 2、删除这个企业
        if ($result) {
            return redirect('/enterprise/index');
        } else {
            echo "删除失败！";
        }
    }

    // 详情
    public function detail($id)
    {
        // 1、从数据库找到企业
        $enterprise = DB::table('enterprise')->where('id', $id)->first();
        // 2、把数据给到页面显示
        return view('enterprise.detail', ['enterprise' => $enterprise]);
    }

    // 编辑页面
    public function edit($id)
    {
        // 1、从数据库找到数据，然后给前端页面显示
        $enterprise = Enterprise::find($id);
        // 2、把数据给到页面显示
        return view('enterprise.edit', ['enterprise' => $enterprise]);
    }

    // 更新程序
    public function update(Request $request)
    {
        // 1、从数据库找到企业
        $enterprise = Enterprise::find($request->input('id'));
        // 2、更新企业信息
        $enterprise->name = $request->input('name');
        $enterprise->abbreviate = $request->input('abbreviate');
        $enterprise->philosophy = $request->input('philosophy');
        $enterprise->description = $request->input('description');
        // 3、更新企业信息
        $result = $enterprise->save();
        // 4、回到首页验证
        if ($result) {
            return redirect('/enterprise/index');
        } else {
            echo "更新失败！";
        }
    }
}
