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
<h1><center>管理员编辑表</center></h1><hr/>

@if ($errors->any()) 
<div class="alert alert-danger"> 
<ul>
@foreach ($errors->all() as $error) 
<li>{{ $error }}</li> 
@endforeach
</ul> 
</div> 
@endif
<form action="{{url('/1908A/admin/update/'.$data->admin_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="admin_tel" value="{{$data->admin_tel}}"
				   placeholder="请输入手机号">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" class="btn btn-default" value="修改">
		</div>
	</div>
</form>
</body>
</html>