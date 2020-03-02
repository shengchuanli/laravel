<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token()}}">
</head>
<body>
<center><h3>1908A商品添加</h3></center>
<form class="form-horizontal" action="{{url('/1908A/goods/store')}}" method="post" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-3">
            <input type="text" name="goods_name" class="form-control" id="firstname"
                   placeholder="请输入名称">
            <b style="color: red">{{$errors->first('goods_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-3">
            <input type="text" name="goods_price" class="form-control" id="firstname"
                   placeholder="请输入价格">
            <b style="color: red">{{$errors->first('goods_price')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-3">
            <input type="file" name="goods_img"  id="firstname">
            <b style="color: red">{{$errors->first('goods_img')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-3">
            <input type="text" name="goods_num" class="form-control" id="firstname"
                   placeholder="请输入库存">
            <b style="color: red">{{$errors->first('goods_num')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否热卖</label>
        <div class="col-sm-3">
            <input type="radio" name="is_hot"  value="1" checked id="firstname">是
            <input type="radio" name="is_hot"  value="2" id="firstname">否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否新品</label>
        <div class="col-sm-3">
            <input type="radio" name="is_new"  value="1" checked id="firstname">是
            <input type="radio" name="is_new"  value="2" id="firstname">否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否首页展示</label>
        <div class="col-sm-3">
            <input type="radio" name="is_show"  value="1"  id="firstname">是
            <input type="radio" name="is_show"  value="2" checked id="firstname">否
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-2">
            <select name="cate_id" id="" class="form-control">
                <option value="">&nbsp;-请选中-</option>
                @foreach($cateall as $k=>$v)
                <option value="{{$v['cate_id']}}">{!! str_repeat('&nbsp;&nbsp;',$v['level']*3)!!}{{$v['cate_name']}}</option>
                    @endforeach
            </select>
            <b style="color: red">{{$errors->first('cate_id')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌</label>
        <div class="col-sm-2">
            <select name="brand_id" id="" class="form-control">
                <option value="">&nbsp;-请选中-</option>
                @foreach($brandall as $k=>$v)
                    <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
            <b style="color: red">{{$errors->first('brand_id')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品详情</label>
        <div class="col-sm-10">
            <textarea name="goods_desc" id="" cols="20" rows="6"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-10">
            <input type="file" name="goods_imgs[]" multiple>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
             <input type="button" value="添加商品">
        </div>
    </div>
</form>

</body>
<script>
    // ajax令牌
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $('input[type=button]').click(function(){
        var goods_name=  $('input[name=goods_name]').val();
        if (goods_name==''){
            return   $('input[name=goods_name]').next().text('js分类名称必填');
        }
        var reg=/^[\u4e00-\u9fa5A-Za-z0-9_]+$/
        if(!reg.test(goods_name)){
            return   $('input[name=goods_name]').next().text('js分类名称是中文数字字母下划线');
        }
         var res=ajaxtest($('input[name=goods_name]'),goods_name);
            if (res===1){
              return  $('input[name=goods_name]').next().text('js已存在');
            }else{
              $('input[name=goods_name]').next().text('ok');
            }
//        /**商品价格*/
                var goods_price= $('input[name=goods_price]').val();
                if (goods_price==''){
                    return  $('input[name=goods_price]').next().text('js商品价格必填');
                }
                var reg=/^\d+$/
                if(!reg.test(goods_price)){
                    return $('input[name=goods_price]').next().text('js商品价格是数字');
                }
        /**库存*/
        var goods_num=  $('input[name=goods_num]').val();
        if (goods_num==''){
            return   $('input[name=goods_num]').next().text('js商品库存必填');
        }
        var reg1=/^\d+$/
        if(!reg1.test(goods_num)){
            return   $('input[name=goods_num]').next().text('js商品库存是数字');
        }
      $('form').submit()
//
    })
    /**商品价格*/
    $('input[name=goods_price]').blur(function(){

            var _this=$(this)
        _this.next().text('')
            var goods_price= _this.val();
    if (goods_price==''){
        return  _this.next().text('js商品价格必填');
    }
    var reg=/^\d+$/
    if(!reg.test(goods_price)){
        return  _this.next().text('js商品价格是数字');
    }
    })
    /**商品c库存*/
    $('input[name=goods_num]').blur(function(){
        var _this=$(this)
        _this.next().text('')
        var goods_num= _this.val();
        if (goods_num==''){
            return  _this.next().text('js商品库存必填');
        }
        var reg=/^\d+$/
        if(!reg.test(goods_num)){
            return  _this.next().text('js商品库存是数字');
        }
    })
    $('input[name=goods_name]').blur(function(){
                var _this=$(this)
        _this.next().text('')
        var goods_name= _this.val();
            if (goods_name==''){
              return  _this.next().text('js商品名称必填');
            }
            var reg=/^[\u4e00-\u9fa5A-Za-z0-9_]+$/
            if(!reg.test(goods_name)){
                return  _this.next().text('js商品名称是中文数字字母下划线');
            }
         var res=ajaxtest(_this,goods_name);
           if (res===1){
             return  _this.next().text('js已存在');
           }else{
             return  _this.next().text('ok');
           }
        });
    function ajaxtest(_this,value){
        var aa=1;
        $.ajax({
            url:'/1908A/goods/ajaxtest',
            type:'post',
            data:{value:value},
            async:false,
            dataType:'json',
            success:function(res){
                if (res.count>0){
                    aa= 1;
                }else{
                    aa= 2;
                }
            }
        });
        return aa
    }
</script>
</html>