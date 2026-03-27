<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>添加页面</title>
</head>

<body>
    <h4>测试post提交</h4>
    <form action="/test/insert" method="post">
        {{csrf_field()}}
        <input type="text" name="name">
        <input type="password" name="pwd">
        <input type="submit" value="提交">
    </form>
</body>

</html>