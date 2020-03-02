<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<h1><center>分类添加表</center></h1><hr/>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{url('/1908A/cate/store')}}" method="post" class="form-horizontal" role="form">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="cate_name" id="firstname"
                   placeholder="请输入用户名">
            <b style="color:red">{{$errors->first('cate_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">父分类</label>
        <div class="col-sm-10">
            <select name="pid" >
                <option value="0">顶级分类</option>
                @foreach($data as $k=>$v)
                    <option value="{{$v['cate_id']}}">{!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}{{$v['cate_name']}}</option>
                @endforeach
            </select>
            <b style="color:red">{{$errors->first('age')}}</b>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-default" value="分类添加">
        </div>
    </div>
</form>

</body>
</html>