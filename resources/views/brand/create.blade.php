<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<center>
<h3>品牌添加</h3>
<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="{{url('1908A/brand/store')}}">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="brand_name" 
				   placeholder="请输入名字">
				   <b style="color:blue">{{$errors->first('brand_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url">
			 <b style="color:blue">{{$errors->first('brand_url')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌logo</label>
		<div class="col-sm-10">
			<input type="file" name="brand_logo">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
</center>	
</body>
</html>
