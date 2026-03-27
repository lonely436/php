<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文件上传</title>
</head>

<body>
    <h3>文件上传</h3>
    <form action="/mulupload" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" multiple name="files[]">
        <input type="submit" name="提交">
    </form>
</body>

</html>