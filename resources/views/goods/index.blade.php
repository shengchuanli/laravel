<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token()}}">
</head>
<body>
<center>
    <h3>商品展示页</h3>
<form action="">
    <input type="text" name="goods_name" value="{{$goods_name??''}}" placeholder="请输入商品名称搜索">
    品牌:
    <select name="brand_id" id="">
        <option value="">-请输入-</option>
        @foreach($brandall as $k=>$v)
            <option value="{{$v->brand_id}}"  @if($brand_id==$v->brand_id)selected @endif>{{$v->brand_name}}</option>
        @endforeach
    </select>
    分类:
    <select name="cate_id" id="">
        <option value="">-请输入-</option>
        @foreach($cateall as $k=>$v)
            <option value="{{$v['cate_id']}}"  @if($cate_id==$v['cate_id'])selected @endif>
                {!! str_repeat('&nbsp;&nbsp;',$v['level']*3)!!}{{$v['cate_name']}}</option>
        @endforeach
    </select>
    <input type="submit" value="搜索">
</form>
<table border="1">
    <tr>
        <td>商品id</td>
        <td>商品名称</td>
        <td>商品库存</td>
        <td>商品价格</td>
        <td>商品分类</td>
        <td>商品品牌</td>
        <td>是否热卖</td>
        <td>是否首页展示</td>
        <td>是否新品</td>
        <td>商品图片</td>
        <td>商品相册</td>
        <td>操作</td>
    </tr>
    @foreach($goodsall as $k=>$v)
    <tr goods_id="{{$v->goods_id}}">
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_num}}</td>
        <td>{{$v->goods_price}}</td>
        <td>{{$v->cate_name}}</td>
        <td>{{$v->brand_name}}</td>
        <td>@if($v->is_hot==1)是 @else 否 @endif</td>
        <td>@if($v->is_show==1)是 @else 否 @endif</td>
        <td>@if($v->is_new==1)是 @else 否 @endif</td>
       <td>
            <img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" height="50px" width="50px">
        </td>
        <td>
            @if($v->goods_imgs)
                @php   $goods_imgs=explode('|',$v->goods_imgs);   @endphp
            @foreach($goods_imgs as $vv)
            <img src="{{env('UPLOAD_URL')}}{{$vv}}" height="20px" width="20px">
                @endforeach
                @endif
        </td>
        <td>
            <a href="javascript:void(0)" class="del" goods_id="{{$v->goods_id}}">删除</a>
            <a href="{{url('/1908A/goods/edit/'.$v->goods_id)}}">修改</a>
        </td>
    </tr>
        @endforeach
</table>
{{$goodsall->appends(['brand_id'=>$brand_id,'cate_id'=>$cate_id,'goods_name'=>$goods_name])->links()}}
</center>
</body>
<script src="/static/js/jquery.min.js"></script>
<script>
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $(document).on('click','.del',function(){
      var _this=$(this);
       var goods_id= _this.attr('goods_id');
        if (confirm('确定删除吗?')) {
            $.post(
                    "/1908A/goods/destroy/"+goods_id,
                    function (res) {
//                    return    console.log(res);
                        if (res.code==00000){
                            location.reload();
                            alert('已删除');
                        }else{
                            alert('删除失败');
                        }
                    },'json'
            )
        }
   })
</script>
</html>