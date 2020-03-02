<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>1908A组团队开发</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<div>
		<ul class="nav navbar-nav">
			<!-- <li class="active"><a href="#">iOS</a></li>
			<li><a href="#">SVN</a></li> -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					管理员
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{{url('/1908A/admin/create')}}">管理员添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('/1908A/admin/index')}}">管理员列表</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					商品
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{{url('/1908A/goods/create')}}">商品添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('/1908A/goods/index')}}">商品列表</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					分类
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{{url('/1908A/cate/create')}}">分类添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('/1908A/cate/index')}}">分类列表</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					品牌
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{{url('/1908A/brand/create')}}">品牌添加</a></li>
					<li class="divider"></li>
					<li><a href="{{url('/1908A/brand/index')}}">品牌列表</a></li>
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>

</body>
</html>

