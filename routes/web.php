<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/ok", function () {
    echo "ok";
});

/*
Route::get("/show/{name}/{age}", function ($name, $age) {
    echo $name . $age;
})->where('age', '\d+')->where('name', '[a-zA-z]+');

// 别名路由，不能直接用别名在url中访问
Route::get("user/profile", function () {
    echo "别名路由";
})->name('profile');

// 在程序中使用redirect函数来通过别名访问别名路由地址
Route::get('/xiaoming', function () {
    return redirect()->route('profile');
});

// 路由组
Route::group(array('prefix' => 'test'), function () {
    Route::get('/index', function () {
        echo "index";
    });

    Route::get('/add', function () {
        echo "add";
    });

    Route::get('/detail/{id}', function ($id) {
        echo "detail" . $id;
    })->where('id', '\d+');
});

Route::get('/hello', [TestController::class, 'hello']);

// post路由
Route::group(array('prefix' => 'test'), function () {
    // get方式访问的add
    Route::get('add', [TestController::class, 'add']);

    // post方式访问的insert方法
    Route::post('insert', [TestController::class, 'insert']);
});
*/

// 广东名企
Route::group(array('prefix' => 'enterprise'), function () {
    // 首页
    Route::get('/index', [EnterpriseController::class, 'index']);
    // 添加
    Route::get('/add', [EnterpriseController::class, 'add']);
    Route::post('/insert', [EnterpriseController::class, 'insert']);
    // 修改
    Route::get('/edit/{id}', [EnterpriseController::class, 'edit']);
    Route::post('/update', [EnterpriseController::class, 'update']);
    // 详情
    Route::get('/detail/{id}', [EnterpriseController::class, 'detail']);
    // 删除
    Route::get('/delete/{id}', [EnterpriseController::class, 'delete']);
});

// 资源路由
// Route::resource('articles', ArticleController::class);


Route::get('viewtest1', function () {
    return view('viewtest1', ['city' => '<b>病毒代码</b>', 'enterprise' => '华帝', 'time' => 23]);
});

// for语句
Route::get('viewtest2', function () {
    // $tech_enterprises = ['华为', '美的', '腾讯', '比亚迪', '格力'];
    // $tech_enterprises = [['id' => 1, 'name' => '华为'], ['id' => 2, 'name' => '美的'], ['id' => 3, 'name' => '腾讯'], ['id' => 4, 'name' => '比亚迪'], ['id' => 5, 'name' => '格力']];
    // return view('viewtest3', ['tech_enterprises' => $tech_enterprises]);

    $en1 = new stdClass();
    $en1->id = 1;
    $en1->name = '华帝';

    $en2 = new stdClass();
    $en2->id = 2;
    $en2->name = '明阳';

    $en3 = new stdClass();
    $en3->id = 3;
    $en3->name = '木林森';

    $tech_enterprises = [$en1, $en2, $en3];
    return view('viewtest2', ['tech_enterprises' => $tech_enterprises]);
});

Route::get('/detail', function () {
    return view('enterprise.detail');
});

Route::get('/file', function () {
    return view('file');
});

Route::post('upload', [TestController::class, 'upload']);

Route::get('/mulfile', function () {
    return view('mulfile');
});

// 多文件上传
Route::post('/mulupload', [TestController::class, 'mulupload']);
