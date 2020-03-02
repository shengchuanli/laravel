<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 上下文类</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<form>
		品牌名称:<input type="text" name="brand_name">
				<input type="submit" value="搜索">
	</form>
	<center>
<h3>品牌列表</h3>
<table class="table">
	<thead>
		<tr>
			<th>品牌id</th>
			<th>品牌名称</th>
			<th>品牌url</th>
			<th>品牌logo</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brandall as $v)
		<tr class="success">
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50" height="50"></td>
			<td>
				<a href="{{url('/1908A/brand/destroy/'.$v->brand_id)}}">删除</a>
				<a href="{{url('/1908A/brand/edit/'.$v->brand_id)}}">修改</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</center>
</body>
</html>