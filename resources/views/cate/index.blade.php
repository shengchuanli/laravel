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
<h1><center>分类展示页面</center></h1><hr/>
<table class="table">
	<thead>
		<tr>
			<th>分类id</th>
			<th>分类名称</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($data as $k=>$v)
		<tr @if($k%2==0) class="success" @else class="warning" @endif>
			<td>{{$v['cate_id']}}</td>
			<td>{!! str_repeat('&nbsp;&nbsp;',$v['level']*3) !!}{{$v['cate_name']}}</td>
            <td><a href="{{url('/1908A/cate/edit/'.$v['cate_id'])}}">修改</a> ||  <a href="javascript:;" onclick="del({{$v['cate_id']}})">删除</a></td>
		</tr>
        @endforeach
	</tbody>
</table>


</body>
<script>
    function del(cate_id){
        if(!cate_id){
            return;
        }
        if(confirm('是否确认删除')){
            $.get(
            "/1908A/cate/destroy/"+cate_id,
            // {cate_id:cate_id},
            function(res){
                if(res.code=='00000'){
                    location.reload();
                }
                if(res.code=='11111'){
                    alert('下面有子分类不能删除');
                }
            },
            'json'
        );
        }
        
    }
</script>
</html> 